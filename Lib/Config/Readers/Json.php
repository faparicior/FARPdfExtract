<?php
namespace Faparicior\PdfExtract\Config\Readers;

use Faparicior\PdfExtract\Config\Ifaces\Reader;
use Faparicior\PdfExtract\Exceptions\FileNotExistsException;
use Faparicior\PdfExtract\Exceptions\FileNotReadableException;
use Faparicior\PdfExtract\Exceptions\InvalidParameterException;

class Json implements Reader
{
    const FILENAME = 'filename';

    private $params;

    /**
     * Json constructor.
     * @param array $params
     * @throws FileNotExistsException
     * @throws FileNotReadableException
     * @throws InvalidParameterException
     */
    public function __construct(array $params)
    {
        if (!isset($params[static::FILENAME])) {
            throw new InvalidParameterException();
        }
        if (!file_exists($params[static::FILENAME])) {
            throw new FileNotExistsException();
        }
        if (!is_readable($params[static::FILENAME])) {
            throw new FileNotReadableException();
        }
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function readConfig()
    {
        return $this->getJsonConfigContents($this->params[static::FILENAME]);
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
