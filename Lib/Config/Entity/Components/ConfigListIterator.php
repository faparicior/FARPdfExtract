<?php

namespace Lib\Config\Entity\Components;

use Lib\Config\Entity\ConfigList;

class ConfigListIterator implements \Iterator
{
    /* @var ConfigList $list */
    private $list;
    private $current;

    /**
     * @param ConfigList $listEntity
     */
    public function __construct(ConfigList $listEntity)
    {
        $this->list = $listEntity;
        $this->current = 0;
    }

    /**
     * @return ConfigList
     */
    public function current()
    {
        return $this
            ->list
            ->get($this->current);
    }

    /**
     * @return ConfigList|null
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
