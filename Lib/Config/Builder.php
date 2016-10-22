<?php

namespace Faparicior\PdfExtract\Config;

use Faparicior\PdfExtract\Config\Readers\Json;
use Faparicior\PdfExtract\Config\Readers\Yaml;
use Faparicior\PdfExtract\Config\Readers\Xml;

use Faparicior\PdfExtract\Config\Entity\Components\Config;
use Faparicior\PdfExtract\Config\Entity\Components\TransformPattern;
use Faparicior\PdfExtract\Config\Entity\Components\Coordinates;
use Faparicior\PdfExtract\Config\Entity\Components\Transform;

use Faparicior\PdfExtract\Config\Entity\ConfigList;

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

        foreach ($arrayConfig['config'] as $configElement) {
            $coordinates = $this->decodeCoordinates($configElement);
            $name = $configElement["name"];
            $transform = $this->decodeTransformPatterns($configElement);

            $config = new Config($coordinates, $name, $transform);
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
        $preTransform = $this->decodePreTransform($arrayConfig);
        $postTransform = $this->decodePostTransform($arrayConfig);
        $match = $this->decodeMatch($arrayConfig);

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
        return $arrayConfig["search"]["match"]["pattern"];
    }
}
