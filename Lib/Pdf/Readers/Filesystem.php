<?php

namespace Faparicior\PdfExtract\Pdf\Readers;

use Faparicior\PdfExtract\Pdf\Ifaces\Reader;

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
