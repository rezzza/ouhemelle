<?php
/**
 * Created by PhpStorm.
 * User: armandabric
 * Date: 18/07/2014
 * Time: 12:20
 */

namespace Rezzza\DiagramGenerator\File;


use Rezzza\DiagramGenerator\File;

class Manager {

    public function persist(File $file, $path = null)
    {
        if (null === $file->getPath() && null === $path) {
            throw new \Exception('A path is needed.');
        }

        if (null === $file->getPath()) {
            $file->setPath($path);
        }

        if (!is_writable($file->getFilePath())) {
            throw new \Exception(sprintf('Not writable : "%s".', $file->getFilePath()));
        }

        if (file_exists($file->getFilePath())) {
            throw new \Exception(sprintf('The file "%s" already exist.', $file->getFilePath()));
        }

        return file_put_contents($file->getFilePath(), $file->getContent());
    }

    public function delete(File $file)
    {
        if (!$file->isPersisted()) {
            throw new \Exception('Can\'t delete who isn\'t persisted.');
        }

        return unlink($file->getFilePath());
    }

    /**
     * @param Svg $svg
     * @return File\Png
     */
    public function convertSvgToPng(File\Svg $svg)
    {

    }
} 
