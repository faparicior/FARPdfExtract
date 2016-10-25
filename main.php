<?php

require "vendor/autoload.php";

use Faparicior\PdfExtract\Config\Readers\Json;
use Faparicior\PdfExtract\Config\Builder;
use Faparicior\PdfExtract\Pdf\Readers\Filesystem;
use Faparicior\PdfExtract\PdfInfo\Extractor;

$configReader = new Json(
    [
        'filename' => __DIR__.'/Lib/Tests/TestFiles/config.json'
    ]
);

$configBuilder = new Builder($configReader);
$config = $configBuilder->createConfig();

$fileReader = new Filesystem(__DIR__.'/Lib/Tests/TestFiles/pdftest.pdf');
$fileContents = $fileReader->exec();

$xmlExtractor = new Extractor($config, $fileContents);
$xmlExtractor->exec();

$pdfInfo = $xmlExtractor
    ->getPdfPageInfoList()
    ->arraySerialize();

$pdfInfo = json_encode($xmlExtractor->getPdfPageInfoList(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

file_put_contents(__DIR__.'/Lib/Tests/TestFiles/pdftest.json', $pdfInfo);
