import cv2
from ultralytics import YOLO

model = YOLO("best.pt")
cap = cv2.VideoCapture("video_rak.mp4")

total_frames = int(cap.get(cv2.CAP_PROP_FRAME_COUNT))
fps = cap.get(cv2.CAP_PROP_FPS)
width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))

print(f"Video Info: {width}x{height}, {total_frames} frames, {fps} FPS")

detections = {}

frame_idx = 0
while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        break
    
    results = model(frame, verbose=False)
    boxes = results[0].boxes
    
    for box in boxes:
        cls_id = int(box.cls[0])
        label = model.names[cls_id]
        conf = float(box.conf[0])
        x1, y1, x2, y2 = map(int, box.xyxy[0].cpu().numpy())
        
        if label not in detections:
            detections[label] = []
        detections[label].append({
            "frame": frame_idx,
            "conf": conf,
            "bbox": (x1, y1, x2, y2)
        })
    
    frame_idx += 1

cap.release()

print("\n--- Detection Summary per Class ---")
for label, dets in detections.items():
    confs = [d["conf"] for d in dets]
    avg_conf = sum(confs) / len(confs)
    max_conf = max(confs)
    min_conf = min(confs)
    print(f"Class: {label}")
    print(f"  Count: {len(dets)} detections")
    print(f"  Confidence: Avg={avg_conf:.2f}, Max={max_conf:.2f}, Min={min_conf:.2f}")
    
    # Get unique bounding boxes (rounded to nearest 50 pixels to group nearby boxes)
    bboxes = [d["bbox"] for d in dets]
    grouped_bboxes = {}
    for bbox in bboxes:
        # Group by approx position
        key = (round(bbox[0]/50)*50, round(bbox[1]/50)*50, round(bbox[2]/50)*50, round(bbox[3]/50)*50)
        grouped_bboxes[key] = grouped_bboxes.get(key, 0) + 1
        
    print("  Approximate coordinates & frequency:")
    for bbox_key, freq in sorted(grouped_bboxes.items(), key=lambda x: x[1], reverse=True)[:3]:
        print(f"    {bbox_key}: {freq} times")
