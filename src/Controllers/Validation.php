<?php

namespace App\Controllers;

/**
* Validation Class 
*
* PHP 7
*
* Methods : isEmpty, isEmail and scapeScripts
*
* Checking all data from the client side
*/ 
 class Validation
 {
 	
 	/**
    * Checking empty fields
    * @author Francisco Bizi <franciscobizi@yahoo.com.br>
    * @param array $data
    * @return boolean true or false
    */
    public static function isEmpty($data)
    {
        foreach ($data as $key => $value) {

            if($value == "" || $value == null){

                return true;
            }
        }

        return false;
    }

    /**
    * Validate email field
    * @author Francisco Bizi <franciscobizi@yahoo.com.br>
    * @param array $data
    * @return boolean true or false
    */
    public static function isEmail($data)
    {
        foreach ($data as $key => $value) {

            if($key === "email"){

                return filter_var($value, FILTER_VALIDATE_EMAIL);
            }
        }
    }

    /**
    * Remove scripts
    * @author Francisco Bizi <franciscobizi@yahoo.com.br>
    * @param array $data
    * @return array $data
    */
    public static function scapeTags($data)
    {
        $data = array_map(function($v){

            return trim(strip_tags($v));

        }, $data);

        return $data;
    }

 } 