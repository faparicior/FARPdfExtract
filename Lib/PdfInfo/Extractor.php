<?php

namespace Lib\PdfInfo;

class Extractor
{
    private $config;
    private $fileContents;

    public function __construct($config, $fileContents)
    {
        $this->config = $config;
        $this->fileContents = $fileContents;
    }
}
