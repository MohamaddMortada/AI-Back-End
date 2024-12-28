from flask import Flask, request, jsonify
import cv2
import mediapipe as mp
import numpy as np

app = Flask(__name__)

mp_drawing = mp.solutions.drawing_utils
mp_pose = mp.solutions.pose


def detect_pose():
    if 'image' not in request.files:
        return jsonify({'error': 'No image provided'}), 400

    file = request.files['image']
    img = cv2.imdecode(np.frombuffer(file.read(), np.uint8), cv2.IMREAD_COLOR)

    if img is None:
        return jsonify({'error': 'Could not read the image'}), 400

    with mp_pose.Pose(min_detection_confidence=0.5, min_tracking_confidence=0.5) as pose:
        image_rgb = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        results = pose.process(image_rgb)

    if results.pose_landmarks:
        angles = {}
        landmarks = results.pose_landmarks.landmark

        return jsonify(angles)
    
    return jsonify({'error': 'No pose landmarks detected'}), 400

if __name__ == '__main__':
    app.run(debug=True)