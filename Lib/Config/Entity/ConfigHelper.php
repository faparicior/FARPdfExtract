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
        return $tag
            ."["
                .$this->buildXpath('top', '')
                .$this->buildXpath('left', ',')
                .$this->buildXpath('width', ',')
                .$this->buildXpath('font', ',')
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
