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
            foreach ($this->cell as $index => $particle) {

                $particle->force = $this->calculateForce($index);

            }
            foreach ($this->cell as $index => $particle) {
                $particle->move(time: 1);

                $position = $particle->position;

                if ($t % $output_interval == 0) {
                    $arr = [
                        sprintf("%01.8f", $position->getX()),
                        sprintf("%01.8f", $position->getY()),
                        sprintf("%01.8f", $position->getZ()),
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
        foreach ($cell as $i => $particle) {
            if ($i == $index) {
                continue;
            }

            $gravitation = $this->calculateGravitation($cell[$index], $particle, $this->gravitational_constant);

            $force = $force->add($gravitation);
        }

        return $force;
    }

    /**
     * 2体に働く引力を計算する
     *
     * @param  Particle $a 粒子A
     * @param  Particle $b 粒子B
     * @param  float $g 重力定数
     *
     * @return Force
     */
    public function calculateGravitation(Particle $a, Particle $b, float $g): Force
    {
        $dx = $b->position->getX() - $a->position->getX();
        $dy = $b->position->getY() - $a->position->getY();
        $dz = $b->position->getZ() - $a->position->getZ();

        $r = sqrt($dx * $dx + $dy * $dy + $dz * $dz);

        return new Force(
            $g * $a->mass * $b->mass * ($dx / $r) / $r / $r,
            $g * $a->mass * $b->mass * ($dy / $r) / $r / $r,
            $g * $a->mass * $b->mass * ($dz / $r) / $r / $r
        );
    }
}
