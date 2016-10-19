<?php

namespace Lib\PdfInfo\Entity\Components;

use Lib\PdfInfo\Entity\ValueList;

class ValueListIterator implements \Iterator
{
    /* @var ValueList $list */
    private $list;
    private $current;

    /**
     * @param $valueList
     */
    public function __construct(ValueList $valueList)
    {
        $this->list = $valueList;
        $this->current = 0;
    }

    /**
     * @return Value
     */
    public function current()
    {
        return $this
            ->list
            ->get($this->current);
    }

    /**
     * @return Value|null
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
