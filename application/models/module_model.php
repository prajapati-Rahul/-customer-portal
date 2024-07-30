<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class module_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function postApi($methodName,$url,$body = ''){

        $config['crm_url'] = 'http://localhost/Infinity/Api/V8';
        $config['api_header'] = [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiJhMzBmOGZlOTBlNjRkZDIwN2ZjM2JlOWNmYjZiNzNmNmEzOWFkNTYwZTYwYWRkNjM1YmFkYWI2ZDk1NTFhOWEwYmU1NWU5ZTQ0MTM5MWFmNiIsImlhdCI6MTcyMjI0NDA3Ny44NTI4NjgwODAxMzkxNjAxNTYyNSwibmJmIjoxNzIyMjQ0MDc3Ljg1Mjg3MzA4NjkyOTMyMTI4OTA2MjUsImV4cCI6MTcyMjI0NzY3MS42MDM0MTQwNTg2ODUzMDI3MzQzNzUsInN1YiI6IiIsInNjb3BlcyI6W119.S8qbiaTP8MTRwM5omhZLuae74ne_Q57sy7C25KM7YG7s55Wg7UyZnXQGzG9CtCAaH7RxApsbuppbF6h3A3vM67uA91Sal8h4kPPRoGVx-2fLeWrbgbg7AFdzT6Y_Yi9OF8WHa8KI4aKBVzqDG_ADDkTwddM-nFJkoPGydNxAVeGZ-NVMY_KwKwTbzOAda-uq820Bp1igUOzKVdsApC9TVOOPxzQtaaOmzHCnxlf1D01Zc6PakbVX_41AiQ9qCH5OafmYGJg0wVSsx8f1VReTEPw5b8FY9n8uSxHt7-9FEHcBOPEnzvF5IffFzoP_luyEpID_k0XXwBtr11a7fx1R-A'
                ];
        if(empty($url)) {
            return array("error" => "API configuration missing, Kindly contact technical team!");
        }

        // echo "<pre>";print_r($config.'<br>'.$url.'<br>'.$body.'<br>'.$methodName);die();


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $config['crm_url'].$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $methodName,
            CURLOPT_POSTFIELDS =>json_encode($body),
            CURLOPT_HTTPHEADER => $config['api_header'],
        ));
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response;
        // if(empty($response->access_token)) {
        //     return array("error" => $response->message);
        // } else {
        //     $currentTime = new DateTime();
        //     $currentTime->modify('+30 minutes');
        //     $expiryTime = $currentTime->format('Y-m-d H:i:s');

        //     return  array("success" => "Successfully generated token");
        // }
    }
}
