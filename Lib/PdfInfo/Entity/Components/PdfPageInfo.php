<?php

namespace Faparicior\PdfExtract\PdfInfo\Entity\Components;

use Faparicior\PdfExtract\PdfInfo\Entity\ValueList;

class PdfPageInfo
{
    private $page;
    /* @var ValueList $valueList */
    private $valueList;

    public function __construct($page, ValueList $valueList)
    {
        $this->page = $page;
        $this->valueList = $valueList;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return ValueList
     */
    public function getValueList()
    {
        return $this->valueList;
    }
}
