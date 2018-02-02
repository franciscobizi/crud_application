<?php

namespace App\Middleware;

class SessionMiddleware extends Middleware
{
    protected $container;
    
    public function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal("session", $_SESSION['session']);

        $_SESSION['session'] = $request->getParams();

        $response = $next($request, $response);

        return $response;

    }
}

