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
        
        
        $page      = ($request->getParam('page', 0) > 0) ? $request->getParam('page') : 1;
        $limit     = 2; // Number of posts on one page
        $skip      = ($page - 1) * $limit;
        $events = Event::all();; // Count of all available posts
        $count = $events->count();

        if ($events->isEmpty()) {

            return $this->view->render($response, 'home.twig',[

            'events' => '',
            'total' => ''

            ]); 
        }
        
        return $this->view->render($response, 'home.twig',[
            'pagination'    => [
                'needed'        => $count > $limit,
                'count'         => $count,
                'page'          => $page,
                'lastpage'      => (ceil($count / $limit) == 0 ? 1 : ceil($count / $limit)),
                'limit'         => $limit,
            ],
            'events' => Event::limit($limit)->offset($skip)->get(),
            'total' => $events->count()
        ]);
    }

    public function push(){

        $push = $this->auth->push();

        var_dump($push);
    }

      
}

