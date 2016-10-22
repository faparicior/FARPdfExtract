<?php

namespace Faparicior\PdfExtract\Helper;

class ListEntity
{
    private $configList;
    private $configCount;

    public function __construct()
    {
        $this->configList = array();
        $this->configCount = 0;
    }

    /**
     * @param $config
     */
    public function add($config)
    {
        $this->configList[] = $config;
        $this->configCount++;
    }

    /**
     * @param $config
     */
    public function remove($config)
    {
        for ($i=0; $i<=$this->count(); $i++) {
            if ($this->get($i) == $config) {
                unset($this->configList[$i]);
                $this->configCount--;
            }
        }
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function get($index)
    {
        return $this->configList[$index];
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->configCount;
    }

    /**
     * @return ListIterator
     */
    public function getIterator()
    {
        return new ListIterator($this);
    }
}
