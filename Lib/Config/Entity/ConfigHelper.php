<?php

namespace Lib\Config\Entity;

use Lib\Config\Entity\Components\Config;

class ConfigHelper
{
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

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
        switch ($coordinate) {
            case 'top':
                $xpath = $this->buildParameter(
                    $coordinate,
                    $prepend,
                    $this->config
                        ->getCoordinates()
                        ->getTop()
                );
                break;
            case 'left':
                $xpath = $this->buildParameter(
                    $coordinate,
                    $prepend,
                    $this->config
                        ->getCoordinates()
                        ->getLeft()
                );
                break;
            case 'width':
                $xpath = $this->buildParameter(
                    $coordinate,
                    $prepend,
                    $this->config
                        ->getCoordinates()
                        ->getWidth()
                );
                break;
            case 'font':
                $xpath = $this->buildParameter(
                    $coordinate,
                    $prepend,
                    $this->config
                        ->getCoordinates()
                        ->getFont()
                );
                break;
            default:
                $xpath= '';
                break;
        }
        return $xpath;
    }

    private function buildParameter($coordinate, $prepend, $value)
    {
        $xpath = '';

        if ($value) {
            $xpath = $prepend."@".$coordinate."=".$value;
        }

        return $xpath;
    }
}
