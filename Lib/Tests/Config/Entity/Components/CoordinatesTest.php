<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use Faparicior\PdfExtract\Config\Entity\Components\Coordinates;

class CoordinatesTest extends \PHPUnit_Framework_TestCase
{
    const TOP = 10;
    const LEFT = 20;
    const WIDTH = 30;
    const FONT = 40;

    public function testInstantiation()
    {
        $sut = $this->getCoordinates();
        $this->assertInstanceOf('\Faparicior\PdfExtract\Config\Entity\Components\Coordinates', $sut);
    }

    public function testGetTop()
    {
        $sut = $this->getCoordinates();
        $actual = $sut->getTop();
        $expected = static::TOP;
        
        $this->assertEquals($expected, $actual);
    }

    public function testGetLeft()
    {
        $sut = $this->getCoordinates();
        $actual = $sut->getLeft();
        $expected = static::LEFT;

        $this->assertEquals($expected, $actual);
    }

    public function testGetWidth()
    {
        $sut = $this->getCoordinates();
        $actual = $sut->getWidth();
        $expected = static::WIDTH;

        $this->assertEquals($expected, $actual);
    }

    public function testGetFont()
    {
        $sut = $this->getCoordinates();
        $actual = $sut->getFont();
        $expected = static::FONT;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Coordinates
     */
    private function getCoordinates()
    {
        return new Coordinates(static::TOP, static::LEFT, static::WIDTH, static::FONT);
    }
}
