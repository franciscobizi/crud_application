<?php

// MY SESSIONS CLASS
class SESSIONS
{
    static function start()
	{
        
        //session_start();
        @session_start();
        
    }
    
    static function destroy()
	{
        
        session_destroy();
        
    }
    
    static function getValue($val){
        
        return $_SESSION[$val];
        
    }
    
    
    static function setValue($val,$val1){
        
        $_SESSION[$val]=$val1;
        
    }
    
    static function deleteValue($val){
        
        if(isset($_SESSION[$val])){
            
            unset($_SESSION[$val]);
            
        }
        
    }
    
    static function out(){
        
        if (sizeof($_SESSION)>0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    static function pr_date(){
        $date = date("Y-m-d | H:i");
        return $date;
    }
}
