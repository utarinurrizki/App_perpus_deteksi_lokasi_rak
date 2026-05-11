from flask import Flask, jsonify, send_from_directory
from flask_cors import CORS
from ultralytics import YOLO
import cv2

app = Flask(__name__, static_folder='static')
CORS(app)

# load model hasil training
model = YOLO("best.pt")

# buka kamera (HP / webcam)
cap = cv2.VideoCapture(0)

@app.route('/detect', methods=['GET'])
def detect():
    frame = cv2.imread("rak(34).jpg")

    if frame is None:
        return jsonify({"error": "gambar test.jpg tidak terbaca"})

    results = model(frame)

    annotated = results[0].plot()

    # simpan hasil
    output_path = "static/result.jpg"
    cv2.imwrite(output_path, annotated)

    return jsonify({
        "image":  "result.jpg",
        "status": "success"
    })


@app.route('/static/<path:filename>')
def serve_static(filename):
    return send_from_directory('static', filename)

if __name__ == '__main__':
    app.run(debug=True, port=5000)