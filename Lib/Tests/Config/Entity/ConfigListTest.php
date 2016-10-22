<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use \Faparicior\PdfExtract\Config\Entity\Components\Config;
use \Faparicior\PdfExtract\Config\Entity\Components\Coordinates;
use \Faparicior\PdfExtract\Config\Entity\Components\Transform;
use \Faparicior\PdfExtract\Config\Entity\Components\TransformPattern;
use \Faparicior\PdfExtract\Config\Entity\ConfigList;

class ConfigListTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $sut = new ConfigList();
        $this->assertInstanceOf('\Faparicior\PdfExtract\Config\Entity\ConfigList', $sut);
    }

    public function testCountZeroElements()
    {
        $sut = new ConfigList();
        $actual = $sut->count();
        $expected = 0;

        $this->assertEquals($expected, $actual);
    }

    public function testAddOneConfig()
    {
        $config = $this->getConfig();
        $sut = new ConfigList();
        $sut->add($config);

        $actual = $sut->count();
        $expected = 1;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Config
     */
    private function getMockConfig()
    {
        return $this->createMock('\\Faparicior\\PdfExtract\\Config\\Entity\\Components\\Config');
    }

    /**
     * @return Config
     */
    private function getConfig()
    {
        $coordinates = new Coordinates('10', '20', '30', '40');
        $name = 'dummyConfig';

        $pattern = 'pattern';
        $substitution = 'substitution';
        $preTransform = new TransformPattern($pattern, $substitution);

        $matchFormula = 'matchformula';

        $postTransform = new TransformPattern($pattern, $substitution);

        $transform = new Transform($preTransform, $matchFormula, $postTransform);

        $config = new Config($coordinates, $name, $transform);
        return $config;
    }
}
