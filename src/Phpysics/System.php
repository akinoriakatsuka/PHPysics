<?php

namespace Phpysics;

class System
{
    public array $cell;

    public function __construct(array $cell)
    {
        $this->cell = $cell;
    }

    /**
     * 系を時間発展させて、結果を出力する
     *
     * @param  int $steps 計算するステップ数
     * @param  OutputInterface $output 出力先
     * @param  int $interval 出力する間隔
     *
     * @return void
     */
    public function calculate(int $steps, OutputInterface $output, int $interval = 1): void
    {
        $t = 0;

        $result = [];

        while ($t < $steps) {
            foreach ($this->cell as $index => $molecule) {

                $molecule->force = $this->calculateForce($index);

                $molecule->velocity = $molecule->velocity->add(
                    $molecule->force->toVelocity(mass: $molecule->mass, time: 1)
                );
            }
            foreach ($this->cell as $index => $molecule) {

                $molecule->position = $molecule->position->add(
                    $molecule->velocity->toDistance(time: 1)
                );

                if ($t % $interval == 0) {
                    $arr = [
                        sprintf("%01.8f", $molecule->position->x),
                        sprintf("%01.8f", $molecule->position->y),
                        sprintf("%01.8f", $molecule->position->z),
                    ];
                    $result["#$t"]["#$index"] = $arr;
                }
            }
            $t++;
        }
        $output->write(json_encode($result));
    }

    /**
     * 分子に働く力を計算する
     *
     * @param  array $cell 系
     * @param  int $index 分子のインデックス
     *
     * @return Force
     */
    public function calculateForce(int $index): Force
    {
        $cell = $this->cell;
        $force = new Force(0, 0, 0);

        // 他の分子による引力を計算
        foreach ($cell as $i => $molecule) {
            if ($i == $index) {
                continue;
            }

            $dx = $molecule->position->x - $cell[$index]->position->x;
            $dy = $molecule->position->y - $cell[$index]->position->y;
            $dz = $molecule->position->z - $cell[$index]->position->z;

            $r = sqrt($dx * $dx + $dy * $dy + $dz * $dz);

            $force->x += $dx / $r;
            $force->y += $dy / $r;
            $force->z += $dz / $r;
        }

        return $force;
    }
}
