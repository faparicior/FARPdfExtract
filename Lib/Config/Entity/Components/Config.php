<?php

namespace Lib\Config\Entity\Components;

class Config
{
    /* @var Coordinates $coordinates */
    private $coordinates;
    /* @var Transform $transform */
    private $transform;
    private $name;

    /**
     * @param Coordinates $coordinates
     * @param string $name
     * @param Transform $transform
     */
    public function __construct(Coordinates $coordinates, $name, Transform $transform)
    {
        $this->coordinates = $coordinates;
        $this->name = $name;
        $this->transform = $transform;
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
