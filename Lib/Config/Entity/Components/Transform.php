<?php

namespace Lib\Config\Entity\Components;

class Transform
{
    /* @var TransformPattern $preTransform */
    private $preTransform;
    /* @var TransformPattern $postTransform */
    private $postTransform;

    private $matchFormula;
    private $matchValue;

    /**
     * @param TransformPattern $preTransform
     * @param string $matchFormula
     * @param TransformPattern $postTransform
     */
    public function __construct($preTransform, $matchFormula, $postTransform)
    {
        $this->preTransform = $preTransform;
        $this->matchFormula = $matchFormula;
        $this->postTransform = $postTransform;
    }

    /**
     * @param $value
     * @return string
     */
    public function process($value)
    {
        $value = $this->preProcess($value);
        $this->match($value);
        if ($this->hasMatch()) {
            $value = $this->postProcess($this->matchValue);
        }
        return $value;
    }

    /**
     * @param $value
     * @return string
     */
    private function preProcess($value)
    {
        if (is_null($this->preTransform->getPattern())) {
            return $value;
        }

        return preg_replace(
            $this->preTransform->getPattern(),
            $this->preTransform->getSubstitution(),
            $value
        );
    }

    /**
     * @param $value
     * @return string
     */
    private function postProcess($value)
    {
        if (is_null($this->postTransform->getPattern())) {
            return $value;
        }

        return preg_replace(
            $this->postTransform->getPattern(),
            $this->postTransform->getSubstitution(),
            $value
        );
    }

    /**
     * @param $value
     * @return bool
     */
    private function match($value)
    {
        preg_match($this->matchFormula, $value, $arrayMatches);
        if (count($arrayMatches) > 0) {
            $this->matchValue = $arrayMatches[0];
        }

        return $this->hasMatch();
    }

    /**
     * @return bool
     */
    public function hasMatch()
    {
        return strlen($this->matchValue) > 0;
    }
}
