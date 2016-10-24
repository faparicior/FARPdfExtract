<?php

namespace Faparicior\PdfExtract\PdfInfo;

use Faparicior\PdfExtract\Config\Entity\Components\Transform as TransformEntity;

class Transform
{
    private $transform;
    private $matchValue;

    public function __construct(TransformEntity $transform)
    {
        $this->transform = $transform;
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
            $this->matchValue = $this->postProcess($this->matchValue);
        }
        return $this->hasMatch();
    }

    /**
     * @param $value
     * @return string
     */
    private function preProcess($value)
    {
        $preTransform = $this->transform
            ->getPreTransform();

        if (is_null($preTransform->getPattern())) {
            return $value;
        }

        return preg_replace(
            $preTransform->getPattern(),
            $preTransform->getSubstitution(),
            $value
        );
    }

    /**
     * @param $value
     * @return string
     */
    private function postProcess($value)
    {
        $postTransform = $this->transform
            ->getPreTransform();

        if (is_null($postTransform->getPattern())) {
            return $value;
        }

        return preg_replace(
            $postTransform->getPattern(),
            $postTransform->getSubstitution(),
            $value
        );
    }

    /**
     * @param $value
     * @return bool
     */
    private function match($value)
    {
        $matchFormula = $this->transform
            ->getMatchFormula();

        preg_match($matchFormula, $value, $arrayMatches);
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

    /**
     * @return string
     */
    public function getMatchValue()
    {
        return $this->matchValue;
    }
}
