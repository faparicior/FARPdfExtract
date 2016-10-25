<?php

namespace Faparicior\PdfExtract\Tests\PdfInfo;

use Faparicior\PdfExtract\Config\Builder;
use Faparicior\PdfExtract\Config\Readers\Json;
use Faparicior\PdfExtract\PdfInfo\Extractor;
use Faparicior\PdfExtract\Pdf\Readers\Filesystem;

class ExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $config = $this->getMockConfig();
        $file = $this->getMockFile();
        $sut = new Extractor($config, $file);

        $this->assertInstanceOf('\Faparicior\PdfExtract\PdfInfo\Extractor', $sut);
    }

    public function testExec()
    {
        $config = $this->getConfig();
        $file = $this->getFile();
        $sut = new Extractor($config, $file);

        $sut->exec();
    }

    private function getMockConfig()
    {
        return $this->createMock('\\Faparicior\\PdfExtract\\Config\\Entity\\ConfigList');
    }

    /**
     * @return \Faparicior\PdfExtract\Config\Entity\ConfigList
     */
    private function getConfig()
    {
        $reader = new Json(array('filename'=>__DIR__ . '/../../TestFiles/config.json'));
        $configBuilder = new Builder($reader);

        return $configBuilder->createConfig();
    }

    /**
     * @return string
     */
    private function getMockFile()
    {
        return " ";
    }

    /**
     * @return string
     */
    private function getFile()
    {
        $fileReader = new Filesystem(__DIR__ . '/../TestFiles/pdftest.pdf');
        return $fileReader->exec();
    }
}
