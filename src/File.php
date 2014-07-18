<?php

namespace Rezzza\DiagramGenerator;


class File
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var string
     */
    protected $suffix;

    /**
     * @var string
     */
    protected $path;

    function __construct($name, $content, $suffix, $path = null)
    {
        $this->name = $name;
        $this->content = $content;
        $this->suffix = $suffix;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getFilePath()
    {
        return realpath($this->path . DIRECTORY_SEPARATOR . $this->name . '.' . $this->suffix);
    }

    public function isPersisted()
    {
        return (false !== $this->getFilePath());
    }
} 
