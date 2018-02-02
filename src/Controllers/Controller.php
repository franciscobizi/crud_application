<?php

namespace App\Controllers;
use App\Controllers\Validation;

class Controller extends Validation
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
        
    }
    
    public function __get($property) 
    {
        if($this->container{$property})
        {
            return $this->container{$property};
        
        }
    }
    
}

