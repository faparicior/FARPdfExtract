<?php

namespace Lib\Config\Entity;

use Lib\Config\Entity\Components\Config;
use Lib\Config\Entity\Components\ConfigListIterator;

class ConfigList
{
    private $configList;
    private $configCount;

    public function __construct()
    {
        $this->configList = array();
        $this->configCount = 0;
    }

    /**
     * @param Config $config
     */
    public function add(Config $config)
    {
        $this->configList[] = $config;
        $this->configCount++;
    }

    /**
     * @param Config $config
     */
    public function remove(Config $config)
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
     * @return Config
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
     * @return ConfigListIterator
     */
    public function getIterator()
    {
        return new ConfigListIterator($this);
    }
}
