<?php

namespace IO;

use Phpysics\OutputInterface;

class ConsoleOutput implements OutputInterface
{
    public function write(string $data): void
    {
        echo $data;
    }
}
