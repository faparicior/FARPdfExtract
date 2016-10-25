<?php

namespace Faparicior\PdfExtract\Tests\Config\Readers;

use \Faparicior\PdfExtract\Config\Readers\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\InvalidParameterException
     */
    public function testInstantiationNoParameter()
    {
        $sut = new Json(array());
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Json",
            $sut
        );
    }

    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\InvalidParameterException
     */
    public function testInstantiationIncorrectParameter()
    {
        $sut = new Json(array('key'=>'value'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Json",
            $sut
        );
    }

    /**
     * @expectedException \Faparicior\PdfExtract\Exceptions\FileNotExistsException
     */
    public function testInstantiationFileNotExists()
    {
        $sut = new Json(array('filename'=>__DIR__ . '/../../TestFiles/error.json'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Json",
            $sut
        );
    }

//    /**
//     * @expectedException \Faparicior\PdfExtract\Exceptions\FileNotReadableException
//     */
/*    public function testInstantiationFileNotReadable()
    {
        $sut = new Json(array('filename'=>__DIR__ . '/../../TestFiles/notreadable.json'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Json",
            $sut
        );
    }
*/

    public function testInstantiationEmptyFile()
    {
        $sut = new Json(array('filename'=>__DIR__ . '/../../TestFiles/empty.json'));
        $this->assertInstanceOf(
            "Faparicior\\PdfExtract\\Config\\Readers\\Json",
            $sut
        );
    }

    public function testReadConfigReturnEmptyArray()
    {
        $sut = new Json(array('filename'=>__DIR__ . '/../../TestFiles/empty.json'));
        $this->assertEquals(array(), $sut->readConfig());
    }

    public function testReadConfigReturnValidArray()
    {
        $sut = new Json(array('filename'=>__DIR__ . '/../../TestFiles/config.json'));
        $data = $sut->readConfig();
        $this->assertTrue(isset($data['config']));
    }
}
