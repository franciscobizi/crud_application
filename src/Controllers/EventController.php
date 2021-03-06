<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Controllers\Controller;
use App\Controllers\Auth;

use App\Models\Event;


class EventController extends Controller
{

    public function createEvent($request, $response)
    {
        $arr = explode("T", $_POST['tempo']);
        $Data = $arr[0];
        $Time = $arr[1];

        $uid = $this->auth::userData();

        $datas = [

            'description'=> $_POST['desc'], 'local'=> $_POST['local'],
            'locutor'=> $_POST['locutor'], 'e_date'=> $Data,
            'e_time'=> $Time, 'user_id'=> $uid->id
        ];

        if(parent::isEmpty($datas)){

            $data = ['resp'=>'no', 'msg'=>'Existem campos vazios.'];
            echo json_encode($data);
        }
        
        $datas = parent::scapeTags($datas);


        try {
            
            Event::create($datas);

            $data = ['resp'=>'yes', 'msg'=>'Cadastrado com sucesso.'];
            echo json_encode($data);

        } catch (Exception $e) {
            
            $data = ['resp'=>'no', 'msg'=>'Erro ao cadastrar.'];
            echo json_encode($data);
        }
    }
    

    public function updateEvent($request, $response)
    {
        
        $arr = explode(" ", $request->getParam('tempo'));
        $Data = $arr[0];
        $Time = $arr[1];

        $uid = $this->auth::userData();

        $datas = [

            'description' => $_POST['desc'], 'local' => $_POST['local'],
            'locutor' => $_POST['locutor'], 'e_date' => $Data,
            'e_time' => $Time, 'user_id' => $uid->id
        ];


        if(parent::isEmpty($datas)){

            $data = ['resp'=>'no', 'msg'=>'Existem campos vazios.'];
            echo json_encode($data);
            exit;
        }
        
        $datas = parent::scapeTags($datas);

        try {

            $id = $_POST['uid'];

            Event::where('id', $id)->update($datas);

            $data = ['resp'=>'yes', 'msg'=>'Editado com sucesso.'];
            echo json_encode($data);

        } catch (Exception $e) {
            
            $data = ['resp'=>'no', 'msg'=>'Erro ao editar evento.'];
            echo json_encode($data);
        }
        
        
    }

    
    public function deleteEvent($request, $response)
    {
        
        $id = $_POST['id'];

        try {

            Event::where('id', $id)->delete();
            $data = ['resp'=>'yes', 'msg'=>'Deletado com sucesso.'];
            echo json_encode($data);

        } catch (Exception $e) {
            
            $data = ['resp'=>'no', 'msg'=>'Erro ao deletar.'];
            echo json_encode($data);
        }

    }


}

