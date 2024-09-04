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

                $molecule->force = $this->calculateForce($this->cell, $index);

                $molecule->velocity->x += $molecule->force->x / $molecule->mass;
                $molecule->velocity->y += $molecule->force->y / $molecule->mass;
                $molecule->velocity->z += $molecule->force->z / $molecule->mass;
            }
            foreach ($this->cell as $index => $molecule) {

                $molecule->position->x += $molecule->velocity->x;
                $molecule->position->y += $molecule->velocity->y;
                $molecule->position->z += $molecule->velocity->z;

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
    public function calculateForce(array $cell, int $index): Force
    {
        $force = new Force(0, 0, 0);

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
