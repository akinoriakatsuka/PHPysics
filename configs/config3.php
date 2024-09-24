<?php

// 放物運動のサンプル

$config = [
    'particles' => [
        ['mass' => 1, 'x' => 0, 'y' => 0, 'z' => 0, 'vx' => 15, 'vy' => 0, 'vz' => 50],
    ],
    'constants' => [
        // 'gravitational_constant' => 1,
        // 'reflection_coefficient' => 1,
        'gravitational_acceleration' => 1,
    ],
    'boundary' => [
        // 'x' => [-1000, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 100,
    'interval' => 5,
];

return $config;
