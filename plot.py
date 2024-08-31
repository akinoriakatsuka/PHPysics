import pandas as pd
import matplotlib.pyplot as plt
from mpl_toolkits.mplot3d import Axes3D

# CSVファイルからデータを読み込む
data = pd.read_csv('data.csv')

# データの確認
print(data.head())

# 三次元グラフの作成
fig = plt.figure(figsize=(12, 8))
ax = fig.add_subplot(111, projection='3d')

# 三次元軌跡のプロット
ax.plot(data['x'], data['y'], data['z'], marker='o', linestyle='-', color='b')

# グラフのタイトルとラベル
ax.set_title('3D Trajectory Plot')
ax.set_xlabel('X Axis')
ax.set_ylabel('Y Axis')
ax.set_zlabel('Z Axis')

# グリッドを表示
ax.grid(True)

# グラフを表示
plt.show()
