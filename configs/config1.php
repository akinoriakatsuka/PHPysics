<?php

// 等速直線運動のサンプル

$config = [
    'particles' => [
        ['mass' => 1, 'x' => 0, 'y' => 0, 'z' => 0, 'vx' => 1, 'vy' => 0, 'vz' => 0],
    ],
    'constants' => [
        // 'gravitational_constant' => 1,
        // 'reflection_coefficient' => 1,
    ],
    'boundary' => [
        // 'x' => [-1000, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 10,
    'interval' => 1,
];

return $config;