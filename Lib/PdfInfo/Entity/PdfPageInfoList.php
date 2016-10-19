<?php

namespace Lib\PdfInfo\Entity;

use Lib\PdfInfo\Entity\Components\PdfPageInfo;

class PdfPageInfoList
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
     * @return ValueListIterator
     */
    public function getIterator()
    {
        return new ValueListIterator($this);
    }
}
