<?php

namespace Rezzza\DiagramGenerator;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class DiagramController
{
    /**
     * @var Application
     */
    private $add;

    private $filesystem;

    private $svgService;

    private $converter;

    function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function addDiagramAction(Request $request)
    {
        $name = $request->request->get('name');
        $svg = $request->request->get('svg');
        $text = $request->request->get('text');

        $diagram = new Diagram($name, $svg, $text);

        $svgFile = $this->$svgService->create($diagram);
        $this->$filesystem->persist($svgFile, '/path.svg');
        $pngFile = $this->converter->convertSvgToPng($svgFile);
        $this->$filesystem->persist($pngFile);
        $this->$filesystem->delete($svgFile);

        $url = $this->url($pngFile);

        return $this->app->json(array(
            'url' => $url
        ));
    }

} 
