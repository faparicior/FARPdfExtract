<?php

require "vendor/autoload.php";

use Lib\Config\Readers\Json;
use Lib\Config\Builder;
use Lib\Pdf\Readers\Filesystem;
use Lib\PdfInfo\Extractor;

$configReader = new Json();
$configBuilder = new Builder($configReader);
$config = $configBuilder->createConfig();

$fileReader = new Filesystem("./test/pdftest.pdf");
$fileContents = $fileReader->exec();

$xmlExtractor = new Extractor($config, $fileContents);
$xmlExtractor->exec();

/*
$configIterator = $config->getIterator();

foreach ($configIterator as $item) {
    var_dump($item);
}
var_dump($config);
*/