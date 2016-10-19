<?php

namespace Lib\Pdf\Readers;

use Lib\Pdf\Api\Reader;

class Filesystem extends Reader
{
    /**
     * @return string
     */
    public function getFileContents()
    {
        return file_get_contents($this->sourceXml);
    }
}
