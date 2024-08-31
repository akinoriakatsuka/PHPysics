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
     *
     * @return void
     */
    public function calculate(int $steps, OutputInterface $output)
    {
        $t = 0;

        // $output->write("t,x,y,z\n");
        $result = [];

        while ($t < $steps) {
            foreach ($this->cell as $index => $molecule) {

                // 力場を外から与えるようにしたい
                $molecule->force->x = -1 * $molecule->position->x;
                $molecule->force->y = -1 * $molecule->position->y;
                $molecule->force->z = -1 * $molecule->position->z;

                $molecule->velocity->x += $molecule->force->x / $molecule->mass;
                $molecule->velocity->y += $molecule->force->y / $molecule->mass;
                $molecule->velocity->z += $molecule->force->z / $molecule->mass;

                $molecule->position->x += $molecule->velocity->x;
                $molecule->position->y += $molecule->velocity->y;
                $molecule->position->z += $molecule->velocity->z;

                if ($t % 1 == 0) {
                    $arr = [
                        sprintf("%01.8f", $molecule->position->x),
                        sprintf("%01.8f", $molecule->position->y),
                        sprintf("%01.8f", $molecule->position->z),
                    ];
                    $result["#$t"]["#$index"] = $arr;
                    // $output->write(implode(',', $arr) . "\n");
                }
            }
            $t++;
        }
        var_dump($result);
        $output->write(json_encode($result));
    }
}
