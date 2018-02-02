<?php

namespace App\Controllers; 

use Slim\Views\Twig as View;
use App\Controllers\Controller;
use App\Controllers\Auth;
use App\Models\Event;


class HomeController extends Controller
{

    /*
    *  Method to display home page
    */
    public function index($request, $response)
    {
       
        return $this->view->render($response, 'welcome.twig');
        //$msg = "IT'S WORKING...";
        //echo json_encode($msg);
        
    }
  
    /*
    *  Method to reset password
    */
    public function signIn($request, $response)
    {
        $email = $_POST['email'];
        $pass  = $_POST['passw'];

        
        $user = $this->auth::checkUser($email, $pass);
        
        if(!$user)
        {
            
            $data = ['resp'=>'no', 'msg'=>'E-mail ou senha inválida.'];
            echo json_encode($data);
            
        }
        else
        {
            
            $data = ['resp'=>'yes', 'msg'=>'Autenticado com sucesso.'];
            echo json_encode($data);
        }
        
        
    }

    /*
    *  Method to logout
    */
    public function logout($request, $response)
    {
        
        $this->auth->logout();
        

        return $response->withRedirect($this->router->pathFor('index-page'));
    
    }

    /*
    *  Methot to allow user account 
    */
    public function logged($request, $response)
    {
        
        $events = Event::all();
        $count = Event::where('id')->count();

        if (!$events) {

            return $this->view->render($response, 'home.twig',[

            'events' => '',
            'total' => ''

            ]); 
        }
        
        return $this->view->render($response, 'home.twig',[

            'events' => $events,
            'total' => $count
        ]);
    }

      
}

