<?php

namespace Phpysics;

class System
{
    public array $cell;
    public array $boundary;
    public array $constants;

    readonly float $gravitational_constant;
    readonly float $reflection_coefficient;

    public function __construct(
        array $cell,
        array $constants,
        array $boundary = []
    ) {
        $this->cell = $cell;
        // $this->constants = $constants;
        $this->boundary = $boundary;

        $this->gravitational_constant = $constants['gravitational_constant'] ?? 1;
        $this->reflection_coefficient = $constants['reflection_coefficient'] ?? 1;
    }

    /**
     * 系を時間発展させて、結果を出力する
     *
     * @param  int $steps 計算するステップ数
     * @param  OutputInterface $output 出力先
     * @param  int $output_interval 出力する間隔
     *
     * @return void
     */
    public function calculate(int $steps, OutputInterface $output, int $output_interval = 1): void
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

                if ($t % $output_interval == 0) {
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

            $g = $this->gravitational_constant;

            $force->x += $g * $dx / $r;
            $force->y += $g * $dy / $r;
            $force->z += $g * $dz / $r;
        }

        return $force;
    }
}
