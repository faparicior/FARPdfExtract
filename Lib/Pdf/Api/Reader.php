<?php

namespace Faparicior\PdfExtract\Pdf\Api;

abstract class Reader
{
    protected $source;
    protected $sourceXml;

    /**
     * @param string $source
     */
    public function __construct($source)
    {
        $this->source = $source;
        $this->sourceXml = $source.".xml";
    }

    public function pdf2Html()
    {
        $command = "pdftohtml -i -xml "
            .$this->source." "
            .$this->sourceXml;
        ;
        exec($command);
    }

    /**
     * @return string
     */
    public function exec()
    {
        $this->pdf2Html();
        return $this->getFileContents();
    }

    abstract public function getFileContents();
}
