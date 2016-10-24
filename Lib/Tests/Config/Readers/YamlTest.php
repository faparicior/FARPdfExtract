<?php

namespace Faparicior\PdfExtract\Tests\Config\Readers;

use \Faparicior\PdfExtract\Config\Readers\Yaml;

class YamlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\InvalidParameterException
     */
    public function testInstantiationNoParameter()
    {
        $sut = new Yaml(array());
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Yaml",
            $sut
        );
    }

    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\InvalidParameterException
     */
    public function testInstantiationIncorrectParameter()
    {
        $sut = new Yaml(array('key'=>'value'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Yaml",
            $sut
        );
    }

    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\FileNotExistsException
     */
    public function testInstantiationFileNotExists()
    {
        $sut = new Yaml(array('filename'=>__DIR__ . '/../../TestFiles/error.yaml'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Yaml",
            $sut
        );
    }

    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\FileNotReadableException
     */
    public function testInstantiationFileNotReadable()
    {
        $sut = new Yaml(array('filename'=>__DIR__ . '/../../TestFiles/notreadable.json'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Yaml",
            $sut
        );
    }

    public function testInstantiationEmptyFile()
    {
        $sut = new Yaml(array('filename'=>__DIR__ . '/../../TestFiles/empty.json'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Yaml",
            $sut
        );
    }

    public function testReadConfigReturnEmptyArray()
    {
        $sut = new Yaml(array('filename'=>__DIR__ . '/../../TestFiles/empty.json'));
        $this->assertEquals(array(), $sut->readConfig());
    }

    public function testReadConfigReturnValidArray()
    {
        $sut = new Yaml(array('filename'=>__DIR__ . '/../../TestFiles/config.yaml'));
        $data = $sut->readConfig();
        $this->assertTrue(isset($data['config']));
    }
}
