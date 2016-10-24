<?php

namespace Faparicior\PdfExtract\Config\Entity\Components;

class Transform
{
    /* @var TransformPattern $preTransform */
    private $preTransform;

    /* @var TransformPattern $postTransform */
    private $postTransform;

    private $matchFormula;

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
     * @return TransformPattern
     */
    public function getPreTransform()
    {
        return $this->preTransform;
    }

    /**
     * @return TransformPattern
     */
    public function getPostTransform()
    {
        return $this->postTransform;
    }

    /**
     * @return string
     */
    public function getMatchFormula()
    {
        return $this->matchFormula;
    }
}
