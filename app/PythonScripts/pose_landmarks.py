import cv2
import mediapipe as mp
import sys
import json

mp_pose = mp.solutions.pose
pose = mp_pose.Pose(static_image_mode=True, model_complexity=1, enable_segmentation=False, min_detection_confidence=0.5)
mp_drawing = mp.solutions.drawing_utils

def extract_pose_landmarks(image_path):
    image = cv2.imread(image_path)
    image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    results = pose.process(image_rgb)

    if results.pose_landmarks:
        landmarks = [(lm.x, lm.y, lm.z) for lm in results.pose_landmarks.landmark]
        return landmarks
    else:
        return None

if __name__ == "__main__":
    image_path = sys.argv[1] 
    landmarks = extract_pose_landmarks(image_path)

    if landmarks:
        print(json.dumps(landmarks)) 
    else:
        print(json.dumps({'error': 'No landmarks detected.'}))  
