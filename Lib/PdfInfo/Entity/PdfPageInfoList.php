<?php

namespace Lib\PdfInfo\Entity;

use Lib\PdfInfo\Entity\Components\PdfPageInfo;
use Lib\PdfInfo\Entity\Components\PdfPageInfoListIterator;

class PdfPageInfoList implements \JsonSerializable
{
    private $valueList;
    private $valueCount;

    public function __construct()
    {
        $this->valueList = array();
        $this->valueCount = 0;
    }

    /**
     * @param PdfPageInfo $value
     */
    public function add(PdfPageInfo $value)
    {
        $this->valueList[] = $value;
        $this->valueCount++;
    }

    /**
     * @param PdfPageInfo $value
     */
    public function remove(PdfPageInfo $value)
    {
        for ($i=0; $i<=$this->count(); $i++) {
            if ($this->get($i) == $value) {
                unset($this->valueList[$i]);
                $this->valueCount--;
            }
        }
    }

    /**
     * @param int $index
     * @return PdfPageInfo
     */
    public function get($index)
    {
        return $this->valueList[$index];
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->valueCount;
    }

    /**
     * @return PdfPageInfoListIterator
     */
    public function getIterator()
    {
        return new PdfPageInfoListIterator($this);
    }

    public function arraySerialize()
    {
        $pdfPageIterator = $this->getIterator();

        $pages = null;

        /* @var PdfPageInfo $pdfPage */
        foreach ($pdfPageIterator as $pdfPage) {
            $page = null;
            $page['page'] = $pdfPage->getPage();
            $pdfValueIterator= $pdfPage
                ->getValueList()
                ->getIterator();
            foreach ($pdfValueIterator as $pdfValues) {
                $page[$pdfValues->getName()] = $pdfValues->getValue();
            }
            $pages[] = $page;
        }
        return $pages;
    }

    public function jsonSerialize()
    {
        return $this->arraySerialize();
    }
}
