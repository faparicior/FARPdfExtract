<?php

namespace Faparicior\PdfExtract\Config\Entity\Components;

class Coordinates
{
    private $top;
    private $left;
    private $width;
    private $font;

    /**
     * @param string $top
     * @param string $left
     * @param string $width
     * @param string $font
     */
    public function __construct($top, $left, $width, $font)
    {
        $this->top = $top;
        $this->left = $left;
        $this->width = $width;
        $this->font = $font;
    }

    /**
     * @return string
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @return string
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }
}
