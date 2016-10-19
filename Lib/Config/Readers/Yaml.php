<?php

namespace Lib\Config\Readers;

use Lib\Config\Api\Reader;
use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml implements Reader
{
    /**
     * @return array
     */
    public function readConfig()
    {
        return $this->getJsonConfigContents("./config.yaml");
    }

    /**
     * @param $file
     * @return array
     */
    private function getJsonConfigContents($file)
    {
        $config = file_get_contents($file);

        $yamlParser = new YamlParser();
        return $yamlParser->parse($config);
    }
}
