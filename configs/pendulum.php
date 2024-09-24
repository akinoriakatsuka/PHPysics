<?php

// 振り子のシミュレーション

$config = [
    'particles' => [
        ['mass' => 1000, 'x' => 0, 'y' => 0, 'z' => 0, 'vx' => 0.5, 'vy' => 0, 'vz' => 0],
    ],
    'fixed_points' => [
        ['mass' => 1, 'x' => 0, 'y' => 0, 'z' => 50],
    ],
    'constants' => [
        'gravitational_acceleration' => 0.01,
        'spring_constant' => 1000,
        'natural_length' => 50,
    ],
    'boundary' => [
        // 'x' => [-1000, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 1500,
    'interval' => 15,
];

return $config;
