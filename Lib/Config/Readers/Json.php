<?php
namespace Lib\Config\Readers;

use Lib\Config\Api\Reader;

class Json implements Reader
{
    /**
     * @return array
     */
    public function readConfig()
    {
        return $this->getJsonConfigContents("./config.json");
    }

    /**
     * @param $file
     * @return array
     */
    private function getJsonConfigContents($file)
    {
        $config = file_get_contents($file);
        return json_decode($config, true);
    }
}
