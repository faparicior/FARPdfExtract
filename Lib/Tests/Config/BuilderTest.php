<?php

namespace Faparicior\PdfExtract\Tests\Config;

use Faparicior\PdfExtract\Config\Builder;
use Faparicior\PdfExtract\Config\Readers\Json;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $reader = $this->getReader();
        $sut = new Builder($reader);

        $this->assertInstanceOf(
            'Faparicior\\PdfExtract\\Config\\Builder',
            $sut
        );
    }

    public function testCreateConfig()
    {
        $reader = $this->getReader();
        $sut = new Builder($reader);

        $configList = $sut->createConfig();
        $actual = $configList->count();
        $expected = 3;

        $this->assertEquals($expected, $actual);
    }

    private function getReader()
    {
        return new Json(array('filename'=>__DIR__ . '/../TestFiles/config.json'));
    }
}
