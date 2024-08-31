<?php

namespace Io;

use Phpysics\OutputInterface;

class FileOutput implements OutputInterface
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write($data)
    {
        file_put_contents($this->file, $data, FILE_APPEND);
    }
}
