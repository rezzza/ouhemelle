<?php

namespace Rezzza\DiagramGenerator;

class Diagram
{
    /**
     * @var string
     */
    private $uid;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $svg;

    function __construct($uid, $svg, $text)
    {
        $this->uid = $uid;
        $this->svg = $svg;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getSvg()
    {
        return $this->svg;
    }


} 
