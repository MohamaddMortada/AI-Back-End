import matplotlib.pyplot as plt

landmarks = {
    "Nose": (0.34092003107070923, 0.34002208709716797),
    "Left Eye": (0.3348924219608307, 0.32165762782096863),
    "Right Eye": (0.33578529953956604, 0.3148338794708252),
    "Left Ear": (0.33659136295318604, 0.30737438797950745),
    "Right Ear": (0.3319527804851532, 0.3332563042640686),
    "Left Shoulder": (0.3308771848678589, 0.33486902713775635),
    "Right Shoulder": (0.32970890402793884, 0.33622196316719055),
    "Left Elbow": (0.34189143776893616, 0.28189682960510254),
    "Right Elbow": (0.333234041929245, 0.3189964294433594),
    "Left Wrist": (0.35141563415527344, 0.3311357796192169),
    "Right Wrist": (0.34842562675476074, 0.3431183695793152),
    "Left Hip": (0.4001997113227844, 0.2581805884838104),
    "Right Hip": (0.3676360249519348, 0.3404785990715027),
    "Left Knee": (0.45022115111351013, 0.14223000407218933),
    "Right Knee": (0.30529075860977173, 0.39557692408561707),
    "Left Ankle": (0.5318928360939026, 0.07779856026172638),
    "Right Ankle": (0.2634774446487427, 0.2906392514705658),
    "Left Foot": (0.5522304177284241, 0.05549388751387596),
    "Right Foot": (0.24892058968544006, 0.26244106888771057)
}

x_coords = [landmark[0] for landmark in landmarks.values()]
y_coords = [landmark[1] for landmark in landmarks.values()]

plt.figure(figsize=(8, 8))
plt.scatter(x_coords, y_coords, color='blue')

for label, (x, y) in landmarks.items():
    plt.annotate(label, (x, y), textcoords="offset points", xytext=(0, 5), ha='center')

plt.xlabel('X')
plt.ylabel('Y')
plt.title('2D Pose Landmarks (X-Y plane)')

plt.gca().set_aspect('equal', adjustable='box')
plt.grid(True)
plt.show()
