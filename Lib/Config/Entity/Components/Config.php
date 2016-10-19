<?php

namespace Lib\Config\Entity\Components;

class Config
{
    /* @var Coordinates $coordinates */
    private $coordinates;
    /* @var Transform $transform */
    private $transform;

    public function __construct($coordinates, $xmlTransform)
    {
        $this->coordinates = $coordinates;
        $this->transform = $xmlTransform;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @return Transform
     */
    public function getTransform()
    {
        return $this->transform;
    }
}
