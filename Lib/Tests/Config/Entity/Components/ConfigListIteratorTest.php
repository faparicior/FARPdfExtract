<?php

namespace Faparicior\PdfExtract\Tests\Config\Entity;

use \Faparicior\PdfExtract\Config\Entity\Components\ConfigListIterator;
use \Faparicior\PdfExtract\Config\Entity\ConfigList;

class ConfigListIteratorTest extends \PHPUnit_Framework_TestCase
{
    const NAME_CONFIG_1  ='Config1';
    const NAME_CONFIG_2  ='Config2';

    public function testInstantiation()
    {
        $sut = $this->getConfigListIterator();
        $this->assertInstanceOf('\Faparicior\PdfExtract\Config\Entity\Components\ConfigListIterator', $sut);
    }

    public function testCurrent()
    {
        $sut = $this->getConfigListIterator();

        $actual = $sut->current();
        $expected= '\Faparicior\PdfExtract\Config\Entity\Components\Config';
        
        $this->assertInstanceOf($expected, $actual);
        
    }

    public function testNext()
    {
        $sut = $this->getConfigListIterator();
        $sut->rewind();

        $actual = $sut->next()->getName();
        $mockConfig = $this->getMockConfig1();
        $expected = $mockConfig->getName();

        $this->assertEquals($expected, $actual);
    }

    public function testKey()
    {
        $sut = $this->getConfigListIterator();
        $sut->rewind();

        $actual = $sut->key();
        $expected = 0;

        $this->assertEquals($expected, $actual);

        $sut->next();
        $actual = $sut->key();
        $expected = 1;
        $this->assertEquals($expected, $actual);
    }

    private function getConfigListIterator()
    {
        $config = $this->getMockConfig1();
        $config2 = $this->getMockConfig2();

        $configList = new ConfigList();
        $configList->add($config);
        $configList->add($config2);

        return new ConfigListIterator($configList);
    }

    private function getMockConfigList()
    {
        return $this->createMock('\\Faparicior\\PdfExtract\\Config\\Entity\\ConfigList');
    }

    private function getMockConfig1()
    {
        return $this->getMockConfig(static::NAME_CONFIG_1);
    }

    private function getMockConfig2()
    {
        return $this->getMockConfig(static::NAME_CONFIG_2);
    }

    private function getMockConfig($name)
    {
        $mock = $this->createMock('\\Faparicior\\PdfExtract\\Config\\Entity\\Components\\Config');

        $mock->method("getName")
            ->willReturn($name);

        return $mock;
    }
}
