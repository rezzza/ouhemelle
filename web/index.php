<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;
$app['cache.dir'] = __DIR__ . '/../cache';

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/views',
    'twig.options'          => array(
        'charset'           => 'utf-8',
        'strict_variables'  => true,
        'cache'             => $app['cache.dir']
    )
));


// http://silex.sensiolabs.org/doc/cookbook/json_request_body.html#parsing-the-request-body
$app->before(function (Symfony\Component\HttpFoundation\Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app['diagram.controller'] = $app->share(function() use ($app) {
        return new Rezzza\DiagramGenerator\DiagramController($app);
    });

$app->get('/', function() use($app) {
        return $app['twig']->render('home.twig', array());
    });


//$app->post('/api/diagrams.json', function() use ($app) {
//    return $app->json(array('toto'=> 42));
//});
//$app->get('/hello/{name}', function($name) use($app) {
//    return 'Hello '.$app->escape($name);
//});





$app->post('/api/diagrams.json', "diagram.controller:addDiagramAction");


$app->run();

