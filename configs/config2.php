<?php

// 等加速度運動（落下）のサンプル

$config = [
    'particles' => [
        ['mass' => 100, 'x' => 0, 'y' => 0, 'z' => 100, 'vx' => 0, 'vy' => 0, 'vz' => 0],
    ],
    'constants' => [
        // 'gravitational_constant' => 1,
        // 'reflection_coefficient' => 1,
        'gravitational_acceleration' => 1,
    ],
    'boundary' => [
        // 'x' => [0, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 10,
    'interval' => 1,
];

return $config;