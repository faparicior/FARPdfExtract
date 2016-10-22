<?php

namespace Faparicior\PdfExtract\PdfInfo\Entity;

use Faparicior\PdfExtract\PdfInfo\Entity\Components\Value;
use Faparicior\PdfExtract\PdfInfo\Entity\Components\ValueListIterator;

class ValueList
{
    private $valueList;
    private $valueCount;

    public function __construct()
    {
        $this->valueList = array();
        $this->valueCount = 0;
    }

    /**
     * @param Value $value
     */
    public function add(Value $value)
    {
        $this->valueList[] = $value;
        $this->valueCount++;
    }

    /**
     * @param Value $value
     */
    public function remove(Value $value)
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
     * @return Value
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
