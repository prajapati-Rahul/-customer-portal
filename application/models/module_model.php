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
                    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiJlZjdlZWM5NzRiYzRkODMxZWUzMjc2ZmM3NjQ2MDFlOTc2YzQ5Nzc5YTFmMzRkZjRkODYwN2UyMjdhMTIxMTM0ZTA3YmE2OGNjYzRmZDhlMiIsImlhdCI6MTcyMTk4MjE4My40ODQ2NTIwNDIzODg5MTYwMTU2MjUsIm5iZiI6MTcyMTk4MjE4My40ODQ2NTM5NDk3Mzc1NDg4MjgxMjUsImV4cCI6MTcyMTk4NTc4My4yMjgzNzcxMDM4MDU1NDE5OTIxODc1LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.JAdOUFKsyai1yfnMjxjmjApfnxLRGMRsyrj3N_o0cALFkBvUVjkc3QzilGptqyYTVPeeeqTR4prHnuXnMpJ9o11RHrLu55JJmdRo0_nasLHZ6t2kLpw_TnnQt4JT9U_6x--E4TbqmdsJaRriXcB7bi2dgNA-WKQDUAIDIyDloc9vaB91bpuumKNOG3Jqp3vTzzLuu5dz8Qu6_7HOzQQidQSpO_cn6z4nnHGM8-ZnA3FKz2BWUuUzwjTd2Jb0oScLO7gwHbGJsG12UbvoKpQ2HFxSxDD0kZaKCA-EpwiPOFzyiXPqFHNnsX2Ro2JCBpg4T434EdKUTVRqRJOjodsJsg'
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
