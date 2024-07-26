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

    function postApi($methodName,$url,$bod = ''){

        $config['crm_url'] = 'http://localhost/Infinity/Api/V8';
        $config['api_header'] = [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiI5MWFhYzIwZDBiZjU5NmM2NTczMTdjNTUwMjAyM2VmNWFiZThmNTkxMjAyYjQ1ODlmYTg2OWVmNzdlMjczYTkzNTlhZWIzYmU2MTcyMDlhZSIsImlhdCI6MTcyMjAwMDg4OC4yNzkxMDgwNDc0ODUzNTE1NjI1LCJuYmYiOjE3MjIwMDA4ODguMjc5MTEwOTA4NTA4MzAwNzgxMjUsImV4cCI6MTcyMjAwNDQ4OC4wMTcyMDMwOTI1NzUwNzMyNDIxODc1LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.FPnpKxRiEcFczFOROHOUFY6QFSwRWAruAM8H9riYspEo9hMf5kTfCYXG15sfY5Jec9WC6XyGS_WHX94E150VAbiXtsiwCw18CDm8yIABUf5490QCWYj4BHwFHnbKPpFw8sSOZDuXCBlrhBcDswNbD6qsR8rs1UxYJLNb67rRK1CqvgFIfiK_e9ZbCVXqWS4iXWWfAlKqCgyRrYTSkoCfKKrK_9mI1L3Xu7OF1-INJWAyh8MDeLTgOWUNxDNtkC15kPaOPrJoQ_zMeOGjTY0RRJugp3y-LU5Q_AwmSKeFPUFShzP8zz6wjCHicZYrbvliUTCfqebMHXdIODi3NSl5-g'
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
