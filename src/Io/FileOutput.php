<?php

namespace Io;

use Phpysics\OutputInterface;

class FileOutput implements OutputInterface
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function write(string $data): void
    {
        file_put_contents($this->file, $data, FILE_APPEND);
    }
}
