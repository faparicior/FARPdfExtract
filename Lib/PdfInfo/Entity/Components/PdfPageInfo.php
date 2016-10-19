<?php

namespace Lib\PdfInfo\Entity\Components;

class PdfPageInfo
{
    private $page;
    private $valueList;

    public function __construct($page, $valueList)
    {
        $this->page = $page;
        $this->valueList = $valueList;
    }
}
