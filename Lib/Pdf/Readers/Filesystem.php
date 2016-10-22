<?php

namespace Faparicior\PdfExtract\Pdf\Readers;

use Faparicior\PdfExtract\Pdf\Api\Reader;

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
