import json
import numpy as np
import matplotlib.pyplot as plt
from mpl_toolkits.mplot3d import Axes3D

# JSONファイルを読み込む
with open('data.json', 'r') as file:
    data = json.load(file)

# 各粒子のデータを時間順に整理
particles = {}
for time, particles_data in data.items():
    for particle_id, position in particles_data.items():
        if particle_id not in particles:
            particles[particle_id] = {"x": [], "y": [], "z": []}
        particles[particle_id]["x"].append(float(position[0]))
        particles[particle_id]["y"].append(float(position[1]))
        particles[particle_id]["z"].append(float(position[2]))

# 3Dプロットの準備
fig = plt.figure()
ax = fig.add_subplot(111, projection='3d')

# 各粒子の軌跡をプロット
for particle_id, coords in particles.items():
    ax.plot(coords["x"], coords["y"], coords["z"], label=f'Particle {particle_id}')

# グラフのタイトルとラベル
ax.set_title('3D Trajectory Plot')
ax.set_xlabel('X Axis')
ax.set_ylabel('Y Axis')
ax.set_zlabel('Z Axis')

# グリッドを表示
ax.grid(True)

# グラフを表示
plt.show()
