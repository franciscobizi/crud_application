<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Controllers\Controller;
use App\Controllers\Auth;

use App\Models\Event;


class EventController extends Controller
{

   
    /*
     * @METHOD THAT ADD EVENT
     */
    public function createEvent($request, $response)
    {
        try {
            
            Event::create([

                'desc'=> $request->getParam('desc'),
                'local'=> $request->getParam('local'),
                'locutor'=> $request->getParam('locutor'),
                'e_date'=> $Data,
                'e_time'=> $Time,
                'user_id'=> $request->getParam('uid')

            ]);

            $data = ['resp'=>'yes', 'msg'=>'Cadastrado com sucesso.'];
            echo json_encode($data);

        } catch (Exception $e) {
            
            $data = ['resp'=>'no', 'msg'=>'Erro ao cadastrar.'];
            echo json_encode($data);
        }
    }
    

    /*
    *  Methot that edit events 
    */
    public function updateEvent($request, $response)
    {
        
        $arr = explode(" ", $request->getParam('hora'));
        $Data = $arr[0];
        $Time = $arr[1];

        $uid = $this->auth::userData();

        $datas = [
        'description' => $_POST['desc'],
        'local' => $_POST['local'],
        'locutor' => $_POST['nome'],
        'e_date' => $Data,
        'e_time' => $Time,
        'user_id' => $uid->id,
        'updated_at' => date('Y-m-d H:i')
        ];
        
        try {

            Event::where('id', $_POST['ide'])->update($datas);

            $data = ['resp'=>'yes', 'msg'=>'Cadastrado com sucesso.'];
            echo json_encode($data);

        } catch (Exception $e) {
            
            $data = ['resp'=>'no', 'msg'=>'Erro ao editar evento.'];
            echo json_encode($data);
        }
        
        
    }

    /*
    *  Methot to delete events 
    */
    public function deleteEvent($request, $response)
    {
        
        $id = $_POST['eid'];

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

