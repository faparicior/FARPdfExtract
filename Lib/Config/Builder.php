<?php

namespace Lib\Config;

use Lib\Config\Readers\Json;
use Lib\Config\Readers\Yaml;
use Lib\Config\Readers\Xml;

use Lib\Config\Entity\Components\Config;
use Lib\Config\Entity\Components\TransformPattern;
use Lib\Config\Entity\Components\Coordinates;
use Lib\Config\Entity\Components\Transform;

use Lib\Config\Entity\ConfigList;

class Builder
{
    private $reader;

    /**
     * @param Json|Yaml|Xml $reader
     */
    public function __construct($reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return ConfigList
     */
    public function createConfig()
    {
        $arrayConfig = $this->reader->readConfig();

        $configList = new ConfigList();
        $coordinates = null;

        foreach ($arrayConfig as $configElement) {
            $coordinates = $this->decodeCoordinates($configElement);
            $transform = $this->decodeTransformPatterns($configElement);

            $config = new Config($coordinates, $transform);
            $configList->add($config);
        }
        return $configList;
    }

    /**
     * @param $arrayConfig
     * @return Coordinates
     */
    private function decodeCoordinates($arrayConfig)
    {
        $coordinates = $arrayConfig["coordinates"];

        return new Coordinates(
            $coordinates["top"],
            $coordinates["left"],
            $coordinates["width"],
            $coordinates["font"]
        );
    }

    /**
     * @param $arrayConfig
     * @return Transform
     */
    private function decodeTransformPatterns($arrayConfig)
    {
        $arrayTransform = $arrayConfig["transform"];

        $preTransform = $this->decodePreTransform($arrayTransform);
        $postTransform = $this->decodePostTransform($arrayTransform);
        $match = $this->decodeMatch($arrayTransform);

        return new Transform($preTransform, $match, $postTransform);
    }

    /**
     * @param $arrayConfig
     * @return TransformPattern
     */
    private function decodePreTransform($arrayConfig)
    {
        return $this->decodeTransformPattern($arrayConfig["pretransform"]);
    }

    /**
     * @param $arrayConfig
     * @return TransformPattern
     */
    private function decodePostTransform($arrayConfig)
    {
        return $this->decodeTransformPattern($arrayConfig["posttransform"]);
    }

    /**
     * @param $arrayPattern
     * @return TransformPattern
     */
    private function decodeTransformPattern($arrayPattern)
    {
        return new TransformPattern(
            $arrayPattern["pattern"],
            $arrayPattern["substitution"]
        );
    }

    /**
     * @param $arrayConfig
     * @return string
     */
    private function decodeMatch($arrayConfig)
    {
        return $arrayConfig["match"]["pattern"];
    }
}
