<?php

namespace Faparicior\PdfExtract\Helper;

use Faparicior\PdfExtract\Config\Entity\Components\Config;

class XPathHelper
{
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    // TODO: Move to Config

    public function getXpath($tag)
    {
        $and = ' and ';
        return $tag
            ."["
                .$this->buildXpath('top', '')
                .$this->buildXpath('left', $and)
                .$this->buildXpath('width', $and)
                .$this->buildXpath('font', $and)
            ."]";
    }

    private function buildXpath($coordinate, $prepend)
    {
        $func = 'get' . ucfirst($coordinate);
//        $value = $this->config->getCoordinates()->getTop();

        $value = $this->config->getCoordinates()->$func();

        if (!$value) {
            return '';
        }
        return $prepend."@".$coordinate."=".$value;
    }
}
