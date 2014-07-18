<?php

namespace Rezzza\DiagramGenerator\File;

use Rezzza\DiagramGenerator\Diagram;
use Rezzza\DiagramGenerator\File;

class Svg extends File
{

    function __construct($name, $content, $path = null)
    {
        parent::__construct($name, $content, 'svg', $path);
    }

    /**
     * @param Diagram $diagram
     * @return Svg
     */
    static public function fromDiagram(Diagram $diagram)
    {
        return new self($diagram->getUid(), $diagram->getSvg());
    }
} 
