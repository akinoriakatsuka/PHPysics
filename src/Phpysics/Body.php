<?php

namespace Phpysics;

abstract class Body {
    public float $mass;
    public Coordinate $position;
    public Velocity $velocity;
    public Force $force;
}
