<?php

// バネで繋がれた2つの質点のシミュレーション

$config = [
    'particles' => [
        ['mass' => 1000, 'x' => 25, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => 0, 'vz' => 0],
        ['mass' => 100, 'x' => 0, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => 0, 'vz' => 0],
    ],
    'constants' => [
        'gravitational_constant' => 0,
        'reflection_coefficient' => 0,
        'spring_constant' => 1,
        'natural_length' => 50,
    ],
    'boundary' => [
        // 'x' => [-1000, 1000],
        // 'y' => [-1000, 1000],
        // 'z' => [-1000, 1000],
    ],
    'steps' => 100,
    'interval' => 1,
];

return $config;
