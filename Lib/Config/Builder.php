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

        // TODO: Gestionar valores nulos de configuración

        $arrayModel = [
            'top' => null,
            'left' => null,
            'width' => null,
            'font' => null
        ];

        $arrayModel = array_replace($arrayModel, $coordinates);

        return new Coordinates(
            $arrayModel["top"],
            $arrayModel["left"],
            $arrayModel["width"],
            $arrayModel["font"]
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
        if (!isset($arrayConfig['pretransform'])) {
            return null;
        }

        return $this->decodeTransformPattern($arrayConfig["pretransform"]);
    }

    /**
     * @param $arrayConfig
     * @return TransformPattern
     */
    private function decodePostTransform($arrayConfig)
    {
        if (!isset($arrayConfig['posttransform'])) {
            return null;
        }

        return $this->decodeTransformPattern($arrayConfig["posttransform"]);
    }

    /**
     * @param $arrayPattern
     * @return TransformPattern
     */
    private function decodeTransformPattern($arrayPattern)
    {
        $arrayModel = [
            'pattern' => null,
            'substitution' => null
        ];

        $arrayModel = array_replace($arrayModel, $arrayPattern);

        return new TransformPattern(
            $arrayModel["pattern"],
            $arrayModel["substitution"]
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
