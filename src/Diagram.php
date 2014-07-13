<?php
namespace Rezzza\DiagramGenerator;


class Diagram {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $svg;

    function __construct($name, $svg, $text)
    {
        $this->name = $name;
        $this->svg = $svg;
        $this->text = $text;
    }
} 
