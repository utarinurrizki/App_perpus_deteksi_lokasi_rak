from flask import Flask, jsonify, send_from_directory, Response
from flask_cors import CORS
from ultralytics import YOLO
from collections import deque
import cv2
import os

app = Flask(__name__, static_folder="static")
CORS(app)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
STATIC_DIR = os.path.join(BASE_DIR, "static")
VIDEO_PATH = os.path.join(BASE_DIR, "video_rak3.mp4")

os.makedirs(STATIC_DIR, exist_ok=True)

model = YOLO("best.pt")

print("YOLO CLASS:")
print(model.names)


def convert_db_to_yolo(name):

    name = name.lower()

    name = name.replace("rak", "")
    name = name.replace(" ", "")
    name = name.replace("-", "_")
    name = name.replace(".", "_")

    return "rak_" + name.strip("_")


def convert_yolo_to_display(label):

    text = label.replace("rak_", "")
    text = text.replace("_", ".")

    parts = text.split(".")

    if len(parts) >= 4:

        left = ".".join(parts[:2])
        right = ".".join(parts[2:])

        return f"Rak {left} - {right}"

    elif len(parts) >= 2:

        mid = len(parts) // 2

        left = ".".join(parts[:mid])
        right = ".".join(parts[mid:])

        return f"Rak {left} - {right}"

    return f"Rak {text}"


@app.route("/detect", methods=["GET"], strict_slashes=False)
def detect_info():

    return jsonify({
        "status": "info",
        "pesan": "Tambahkan nama rak setelah /detect/",
        "contoh_url": "/detect/Rak%20000%20-%20001",
        "contoh_label_yolo": "/detect/rak_000_001"
    })


@app.route("/detect/<path:rack_name>", methods=["GET"])
def detect(rack_name):

    target = convert_db_to_yolo(rack_name)

    print("Target:", target)

    cap = cv2.VideoCapture(VIDEO_PATH)

    best_box = None
    best_conf = 0.0
    best_frame = None

    while cap.isOpened():

        ret, frame = cap.read()

        if not ret:
            break

        results = model(
            frame,
            conf=0.90,
            verbose=False
        )

        boxes = results[0].boxes

        if len(boxes) == 0:
            continue

        for box in boxes:

            cls_id = int(box.cls[0])
            label = model.names[cls_id]

            if label != target:
                continue

            confidence = float(box.conf[0])

            if confidence > best_conf:

                best_conf = confidence
                best_box = box
                best_frame = frame.copy()

    cap.release()

    if best_box is None:

        return jsonify({
            "status": "not_found"
        })

    x1, y1, x2, y2 = map(
        int,
        best_box.xyxy[0].cpu().numpy()
    )

    display_label = convert_yolo_to_display(target)

    cv2.rectangle(
        best_frame,
        (x1, y1),
        (x2, y2),
        (0, 255, 255),
        4
    )

    cv2.putText(
        best_frame,
        f"{display_label} {best_conf:.2f}",
        (x1, y1 - 10),
        cv2.FONT_HERSHEY_SIMPLEX,
        1,
        (0, 255, 255),
        3
    )

    filename = f"{target}.jpg"

    save_path = os.path.join(
        STATIC_DIR,
        filename
    )

    cv2.imwrite(
        save_path,
        best_frame
    )

    return jsonify({
        "status": "success",
        "image": filename,
        "confidence": round(best_conf, 3)
    })


def generate_yolo_stream(rack_name):

    target = convert_db_to_yolo(rack_name)

    print("Streaming target:", target)

    cap = cv2.VideoCapture(VIDEO_PATH)

    confidence_history = deque(maxlen=15)

    try:

        while cap.isOpened():

            ret, frame = cap.read()

            if not ret:
                cap.set(cv2.CAP_PROP_POS_FRAMES, 0)
                continue

            results = model(
                frame,
                conf=0.90,
                verbose=False
            )

            boxes = results[0].boxes

            best_box = None
            best_conf = 0.0

            for box in boxes:

                cls_id = int(box.cls[0])

                label = model.names[cls_id]

                if label != target:
                    continue

                confidence = float(box.conf[0])

                if confidence > best_conf:

                    best_conf = confidence
                    best_box = box

            if best_box is not None:

                confidence_history.append(best_conf)

                avg_conf = (
                    sum(confidence_history)
                    / len(confidence_history)
                )

                if avg_conf >= 0.90:

                    x1, y1, x2, y2 = map(
                        int,
                        best_box.xyxy[0].cpu().numpy()
                    )

                    display_label = convert_yolo_to_display(
                        target
                    )

                    cv2.rectangle(
                        frame,
                        (x1, y1),
                        (x2, y2),
                        (0, 255, 255),
                        4
                    )

                    cv2.putText(
                        frame,
                        f"{display_label} {avg_conf:.2f}",
                        (x1, y1 - 10),
                        cv2.FONT_HERSHEY_SIMPLEX,
                        1,
                        (0, 255, 255),
                        3
                    )

            ret, buffer = cv2.imencode(
                ".jpg",
                frame
            )

            if not ret:
                continue

            frame_bytes = buffer.tobytes()

            yield (
                b'--frame\r\n'
                b'Content-Type: image/jpeg\r\n\r\n'
                + frame_bytes +
                b'\r\n'
            )

    finally:

        print("Release stream:", target)

        cap.release()


@app.route("/stream/<path:rack_name>")
def stream(rack_name):

    return Response(
        generate_yolo_stream(rack_name),
        mimetype="multipart/x-mixed-replace; boundary=frame"
    )


@app.route("/static/<path:filename>")
def static_files(filename):

    return send_from_directory(
        STATIC_DIR,
        filename
    )


if __name__ == "__main__":

    app.run(
        debug=True,
        host="0.0.0.0",
        port=5000
    )