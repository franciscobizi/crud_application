<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Event;

class Auth
{
    
    public function push()
    {
        $date = date('Y/m/d', strtotime('+1 days'));
        $push = Event::where('e_date', $date)->first();
        return $push;
    }

    public function checkUser($email, $passw)
    {
        // Check the information on database if exits
        $auth = User::where('email', $email)->first();
        

        if(!$auth)
        {
            return false;
        }

        if(password_verify($passw, $auth->passw))
        {
            $_SESSION['user'] = $auth->id;
            
            return true;
        }

        return false;
        
    }
    
    
    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function userData()
    {
        $id = isset($_SESSION['user']);
        return User::where('id', $id)->first();
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}

