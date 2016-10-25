<?php

namespace Faparicior\PdfExtract\PdfInfo;

use Faparicior\PdfExtract\Helper\XPathHelper;
use Faparicior\PdfExtract\Config\Entity\ConfigList;
use Faparicior\PdfExtract\Config\Entity\Components\Config;

use Faparicior\PdfExtract\PdfInfo\Entity\Components\PdfPageInfo;
use Faparicior\PdfExtract\PdfInfo\Entity\Components\Value;
use Faparicior\PdfExtract\PdfInfo\Entity\PdfPageInfoList;
use Faparicior\PdfExtract\PdfInfo\Entity\ValueList;

class Extractor
{
    /* @var ConfigList $configList */
    private $configList;
    private $fileContents;
    /* @var \SimpleXMLElement $xmlParsed */
    private $xmlParsed;
    /* @var PdfPageInfoList $pdfPageInfoList */
    private $pdfPageInfoList;

    public function __construct(ConfigList $configList, $fileContents)
    {
        $this->configList = $configList;
        $this->fileContents = $fileContents;
        $this->pdfPageInfoList = new PdfPageInfoList();
    }

    public function exec()
    {
        $this->parseXml();
        $this->getValues();
    }

    private function parseXml()
    {
        $this->xmlParsed = new \SimpleXMLElement($this->fileContents);
    }

    private function getValues()
    {
        $pages = $this->getPages();

        foreach ($pages as $page) {
            $pageNum = $this->extractPageNum($page);
            $valueList = $this->extractPageValues($page);
            $pageInfo = new PdfPageInfo($pageNum, $valueList);

            $this->pdfPageInfoList->add($pageInfo);
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
    private function extractPageValues(\SimpleXMLElement $page)
    {
        $valueList = new ValueList();
        // Get values from coordinates
        $configIterator = $this->configList->getIterator();
        foreach ($configIterator as $configItem) {
            $configHelper = new XPathHelper($configItem);
            $xpath = $configHelper->getXpath('text');
            /* @var \SimpleXMLElement[] $elements */
            $elements = $page->xpath($xpath);

            if (count($elements)>0) {
                $value = $this->applyFilters($elements, $configItem);
                // TODO: Discard Null values
                $valueList->add($value);
            }
        }
        return $valueList;
    }

    /**
     * @param \SimpleXMLElement $page
     * @return string
     */
    private function extractPageNum($page)
    {
        $number = $page->attributes()->{'number'};

        // TODO: Review that cast
        return (string)$number;
    }

    /**
     * @param \SimpleXMLElement[] $elements
     * @param Config $configItem
     * @return Value
     */
    private function applyFilters($elements, $configItem)
    {
        $value = null;

        foreach ($elements as $element) {
            $transform = $configItem->getTransform();
            $process = new Transform($transform);


            if ($process->process($element->asXML())) {
                $value = new Value(
                    $configItem->getName(),
                    $process->getMatchValue()
                );
            }
        }
        return $value;
        // TODO: Implements first, second, etc if there's more than one in coordinate
        // Actually returns the last element
    }

    /**
     * @return PdfPageInfoList
     */
    public function getPdfPageInfoList()
    {
        return $this->pdfPageInfoList;
    }
}
