<?php

namespace App\Middleware;

class ValErrosMiddleware extends Middleware
{
    protected $container;
    
    public function __invoke($request, $response, $next)
    {
        //if (!empty($_SESSION['errors']))
        //{
        var_dump('Funciona...');
        die();
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        //}
        
        $response = $next($request, $response);
        
        
        return $response;
    }
}