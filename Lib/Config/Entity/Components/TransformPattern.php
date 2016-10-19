<?php

namespace Lib\Config\Entity\Components;

class TransformPattern
{
    private $pattern;
    private $substitution;

    /**
     * @param string $pattern
     * @param string $substitution
     */
    public function __construct($pattern, $substitution)
    {
        $this->pattern = $pattern;
        $this->substitution = $substitution;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return string
     */
    public function getSubstitution()
    {
        return $this->substitution;
    }
}
