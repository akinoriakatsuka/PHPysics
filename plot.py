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

# 軸範囲を固定するための最小値・最大値の計算
all_x = [x for particle in particles.values() for x in particle["x"]]
all_y = [y for particle in particles.values() for y in particle["y"]]
all_z = [z for particle in particles.values() for z in particle["z"]]

x_min, x_max = min(all_x), max(all_x)
y_min, y_max = min(all_y), max(all_y)
z_min, z_max = min(all_z), max(all_z)

# 各軸の範囲を統一
range_min = min(x_min, y_min, z_min)
range_max = max(x_max, y_max, z_max)

# 軸の範囲を設定
if range_min == range_max:
    range_min -= 1
    range_max += 1

# 各粒子の軌跡をプロット
for particle_id, coords in particles.items():
    ax.plot(coords["x"], coords["y"], coords["z"], label=f'Particle {particle_id}')

# グラフのタイトルとラベル
ax.set_title('3D Trajectory Plot')
ax.set_xlabel('X Axis')
ax.set_ylabel('Y Axis')
ax.set_zlabel('Z Axis')

# 軸の範囲を設定
ax.set_xlim(range_min, range_max)
ax.set_ylim(range_min, range_max)
ax.set_zlim(range_min, range_max)

# グリッドを表示
ax.grid(True)

# 凡例を表示
ax.legend()

# グラフを表示
plt.show()
