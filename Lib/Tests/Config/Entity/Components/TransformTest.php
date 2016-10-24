<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use \Faparicior\PdfExtract\Config\Entity\Components\Transform;
use \Faparicior\PdfExtract\Config\Entity\Components\TransformPattern;

class TransformTest extends \PHPUnit_Framework_TestCase
{
    const MATCH_FORMULA = 'MatchTransform';

    public function testInstantiation()
    {
        $sut = new Transform($this->getMockTransform(), static::MATCH_FORMULA, $this->getMockTransform());

        $this->assertInstanceOf('\Faparicior\PdfExtract\Config\Entity\Components\Transform', $sut);
    }

    public function testGetPreTransform()
    {
        $sut = $this->getTransform();
        $actual = $sut->getPreTransform();
        $expected = $this->getTransformPattern();

        $this->assertEquals($expected, $actual);
    }

    public function testGetPostTransform()
    {
        $sut = $this->getTransform();
        $actual = $sut->getPostTransform();
        $expected = $this->getTransformPattern();

        $this->assertEquals($expected, $actual);
    }

    public function testGetMatchFormula()
    {
        $sut = $this->getTransform();
        $actual = $sut->getMatchFormula();
        $expected = static::MATCH_FORMULA;

        $this->assertEquals($expected, $actual);
    }


    private function getMockTransform()
    {
        return $this->createMock('\\Faparicior\\PdfExtract\\Config\\Entity\\Components\\TransformPattern');
    }

    private function getTransform()
    {
        $preTransform = $this->getTransformPattern();
        $postTransform = $this->getTransformPattern();
        $matchTransform = static::MATCH_FORMULA;

        return new Transform($preTransform, $matchTransform, $postTransform);
    }

    private function getTransformPattern()
    {
        $pattern = 'pattern';
        $substitution = 'substitution';
        return new TransformPattern($pattern, $substitution);
    }
}
