<?php

session_start();

require __DIR__ .'/../vendor/autoload.php';

/*
 * Create app
 */
$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'db_crud',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
        

    ]
    
];
$app = new \Slim\App($config);

// Get container
$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['auth'] = function ($container) {
    return new \App\Controllers\Auth;
};



// Service factory for the ORM
$container['db'] = function ($container) use ($capsule) {
    

    return $capsule;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ .'/../views', [
        'cache' => false
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()
            
    ));

    $view->getEnvironment()->addGlobal("auth",[

        'check' => $container->auth->check(),
        'user'  => $container->auth->userData(),
        'push'  => $container->auth->push(),
        'pushs'  => count($container->auth->push())
    ] );

    return $view;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['EventController'] = function ($container) {
    return new \App\Controllers\EventController($container);
};


require __DIR__ .'/../src/Routes/routes.php';