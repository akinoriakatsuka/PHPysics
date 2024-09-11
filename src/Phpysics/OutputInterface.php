<?php

namespace Phpysics;

interface OutputInterface
{
    public function write(string $data): void;
}
