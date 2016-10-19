<?php

require "vendor/autoload.php";

use Lib\Config\Readers\Json;
use Lib\Config\Builder;
use Lib\Pdf\Readers\Filesystem;

$reader = new Json();
$configBuilder = new Builder($reader);
$config = $configBuilder->createConfig();

$fileReader = new Filesystem("./test/pdftest.pdf");
$fileContents = $fileReader->exec();

$configIterator = $config->getIterator();

foreach ($configIterator as $item) {
    var_dump($item);
}


var_dump($config);
