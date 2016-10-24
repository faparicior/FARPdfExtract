<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use Faparicior\PdfExtract\Config\Entity\Components\TransformPattern;

class TransformPatternTest extends \PHPUnit_Framework_TestCase
{
    const PATTERN = 'pattern';
    const SUBSTITUTION = 'substitution';

    public function testInstantiation()
    {
        $sut = $this->getTransformPattern();
        $this->assertInstanceOf('\Faparicior\PdfExtract\Config\Entity\Components\TransformPattern', $sut);
    }

    public function testGetPattern()
    {
        $sut = $this->getTransformPattern();
        $actual = $sut->getPattern();
        $expected = static::PATTERN;
        
        $this->assertEquals($expected, $actual);
    }

    public function testGetSubstitution()
    {
        $sut = $this->getTransformPattern();
        $actual = $sut->getSubstitution();
        $expected = static::SUBSTITUTION;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return TransformPattern
     */
    private function getTransformPattern()
    {
        return new TransformPattern(static::PATTERN, static::SUBSTITUTION);
    }
}
