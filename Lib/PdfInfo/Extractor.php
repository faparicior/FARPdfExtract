<?php

namespace Lib\PdfInfo;

use Lib\Config\Entity\ConfigHelper;
use Lib\Config\Entity\ConfigList;
use Lib\Config\Entity\Components\Config;

use Lib\PdfInfo\Entity\Components\PdfPageInfo;
use Lib\PdfInfo\Entity\PdfPageInfoList;
use Lib\PdfInfo\Entity\ValueList;

class Extractor
{
    /* @var ConfigList $configList */
    private $configList;
    private $fileContents;
    /* @var \SimpleXMLElement $xmlParsed */
    private $xmlParsed;
    /* @var PdfPageInfo $pdfPageInfo */
    private $pdfPageInfo;


    public function __construct(ConfigList $configList, $fileContents)
    {
        $this->configList = $configList;
        $this->fileContents = $fileContents;
    }

    public function exec()
    {

        $this->parseXml();
        $this->getValues();
/*
        $node = $xmlParsed->xpath('/pdf2xml/page/text[@top="287"]');
        // Iterate over xml pages
        foreach ($xmlParsed['page'] as $page) {
            // Get values
            // Add values to ValueList
            // Add valueList to PdfPageInfo
            var_dump($node);
        }
*/
    }

    private function parseXml()
    {
        $this->xmlParsed = new \SimpleXMLElement($this->fileContents);
    }

    private function getValues()
    {
        $pages = $this->getPages();
        // Iterate over xml pages

        $pageList = new PdfPageInfoList();
        foreach ($pages as $page) {
            $pageNum = $page->attributes()->{'number'};
            $valueList = $this->getValueList($page);
            $pageInfo = new PdfPageInfo($pageNum, $valueList);

            $pageList->add($pageInfo);

//            $elements = $this->getElements($page);
            // Add values to ValueList
            // Add valueList to PdfPageInfo
        }
    }

    /**
     * @return \SimpleXMLElement[]
     */
    private function getPages()
    {
        return $this->xmlParsed->xpath('/pdf2xml/page');
    }

    /**
     * @param \SimpleXMLElement $page
     * @return ValueList
     */
    private function getValueList(\SimpleXMLElement $page)
    {
        // Get values from coordinates
        $configIterator = $this->configList->getIterator();
        foreach ($configIterator as $configItem) {
            $configHelper = new ConfigHelper($configItem);
            $xpath = $configHelper->getXpath('text');
            /* @var \SimpleXMLElement[] $elements */
            $elements = $page->xpath($xpath);
            $this->applyFilters($elements, $configItem);
        }
        return $elements;
    }

    /**
     * @param \SimpleXMLElement[] $elements
     * @param Config $configItem
     */
    private function applyFilters($elements, $configItem)
    {
        foreach ($elements as $element)
        {
            $transform = $configItem->getTransform();
            $arr = $transform->process($element->asXML());
            $arrr = $transform->hasMatch();
        }
    }
}
