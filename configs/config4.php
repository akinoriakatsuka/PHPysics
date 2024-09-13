<?php

// 楕円軌道のサンプル

$config = [
    'particles' => [
        ['mass' => 1, 'x' => 100, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => -12.5, 'vz' => 0],
        ['mass' => 10000, 'x' => 0, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => 0.00125, 'vz' => 0],
    ],
    'constants' => [
        'gravitational_constant' => 1,
        'reflection_coefficient' => 1,
    ],
    'boundary' => [
        // 'x' => [-1000, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 1000,
    'interval' => 5,
];

return $config;