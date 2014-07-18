<?php

namespace Rezzza\DiagramGenerator;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Rezzza\DiagramGenerator\File;

class DiagramController
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var File\Manager
     */
    private $fileManger;

    /**
     * @var string
     */
    private $webPath;

    function __construct(Application $app, Router $router, File\Manager $fileManager, $webPath)
    {
        $this->app = $app;
        $this->router = $router;
        $this->fileManger = $fileManager;
        $this->webPath = $webPath;
    }

    public function addDiagramAction(Request $request)
    {
        $uid = uniqid();
        $svg = $request->request->get('svg');
        $text = $request->request->get('text');

        $diagram = new Diagram($uid, $svg, $text);

        $svgFile = File\Svg::fromDiagram($diagram);
        $this->fileManger->persist($svgFile, $this->webPath . '/svg/');

        $pngFile = $this->fileManger->convertSvgToPng($svgFile);
        $this->filesystem->persist($pngFile);
        $this->filesystem->delete($svgFile);

        $url = $this->router->url($pngFile);

        return $this->app->json(
            array(
                'url' => $url
            )
        );
    }

} 
