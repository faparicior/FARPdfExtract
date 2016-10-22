<?php

namespace Faparicior\PdfExtract\PdfInfo\Entity\Components;

use Faparicior\PdfExtract\PdfInfo\Entity\PdfPageInfoList;

class PdfPageInfoListIterator implements \Iterator
{
    /* @var PdfPageInfoList $list */
    private $list;
    private $current;

    /**
     * @param PdfPageInfoList $valueList
     */
    public function __construct(PdfPageInfoList $valueList)
    {
        $this->list = $valueList;
        $this->current = 0;
    }

    /**
     * @return PdfPageInfo
     */
    public function current()
    {
        return $this
            ->list
            ->get($this->current);
    }

    /**
     * @return PdfPageInfo|null
     */
    public function next()
    {
        $element = null;

        if ($this->valid()) {
            $element = $this
                ->list
                ->get($this->current);
            $this->current ++;
        }

        return $element;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->current;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->current < $this->list->count();
    }

    public function rewind()
    {
        $this->current = 0;
    }
}
