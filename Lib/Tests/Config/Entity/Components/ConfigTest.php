<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use \Faparicior\PdfExtract\Config\Entity\Components\Config;
use \Faparicior\PdfExtract\Config\Entity\Components\Coordinates;
use \Faparicior\PdfExtract\Config\Entity\Components\Transform;
use \Faparicior\PdfExtract\Config\Entity\Components\TransformPattern;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    const CONFIG_NAME = 'dummyConfig';

    public function testGetCoordinates()
    {
        $sut = $this->getConfig();
        $actual = $sut->getCoordinates();
        $expected = $this->getCoordinates();

        $this->assertEquals($expected, $actual);
    }

    public function testGetTransform()
    {
        $sut = $this->getConfig();
        $actual = $sut->getTransform();
        $expected = $this->getTransform();
        
        $this->assertEquals($expected, $actual);
    }

    public function testGetName()
    {
        $sut = $this->getConfig();
        $actual = $sut->getName();
        $expected = static::CONFIG_NAME;
        
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Coordinates
     */
    private function getCoordinates()
    {
        return new Coordinates('10', '20', '30', '40');
    }

    private function getTransform()
    {
        $pattern = 'pattern';
        $substitution = 'substitution';
        $preTransform = new TransformPattern($pattern, $substitution);

        $matchFormula = 'matchformula';

        $postTransform = new TransformPattern($pattern, $substitution);

        return new Transform($preTransform, $matchFormula, $postTransform);
    }

    /**
     * @return Config
     */
    private function getConfig()
    {
        $coordinates = $this->getCoordinates();
        $name = static::CONFIG_NAME;
        $transform = $this->getTransform();

        return new Config($coordinates, $name, $transform);
    }
}
