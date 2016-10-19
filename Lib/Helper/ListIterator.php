<?php

namespace Lib\Helper;

class ListIterator implements \Iterator
{
    /* @var ListEntity $listEntity */
    private $listEntity;
    private $currentEntity;

    /**
     * @param $listEntity
     */
    public function __construct($listEntity)
    {
        $this->listEntity = $listEntity;
        $this->currentEntity = 0;
    }

    /**
     * @return ListEntity
     */
    public function current()
    {
        return $this
            ->listEntity
            ->get($this->currentEntity);
    }

    /**
     * @return ListEntity|null
     */
    public function next()
    {
        $element = null;

        if ($this->valid()) {
            $element = $this
                ->listEntity
                ->get($this->currentEntity);
            $this->currentEntity ++;
        }

        return $element;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->currentEntity;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->currentEntity < $this->listEntity->count();
    }

    public function rewind()
    {
        $this->currentEntity = 0;
    }
}
