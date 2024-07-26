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
                    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiI3M2E2NmI5ZDg5OWNiNjhhYjc0Y2JhNjA1ZThkY2IyZGNmMTYwYjliZDM1ZmFjZTA0OTE0NmZiM2VlZDIzNTM3NDcwYmVlZGEzOGUyOWY3NiIsImlhdCI6MTcyMTk5NzA3OS4yNDM5NTg5NTAwNDI3MjQ2MDkzNzUsIm5iZiI6MTcyMTk5NzA3OS4yNDM5NjEwOTU4MDk5MzY1MjM0Mzc1LCJleHAiOjE3MjIwMDA2NzguOTYwMjU4OTYwNzIzODc2OTUzMTI1LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.YA8rMlmfslWyvp1PKJR1OtQHxbCn3HpTvRj1ZibzFAsNoSMLacUP15tO5fc6PKoRFi6fYC09kCz_0ECic8dthXRjWj8oyR43t8IQj7jWO1i4HPhkYHQQxbruNhw0zclal5T0qSzvge-bETclmPRomnZjry5bJGVvIIeF0QGHEwp45Cv2q4lfE8pzR0x5HbOJDI9UShFjGk9t_-wMHujx8Os-3gIPG25dhiBb5fLhMHwslZzH26xrFV_FKT7mxKBawIGLgVKh9oEwTd899gVHOItlc38Bp4DSyjGdjasjK3LDzZR3mnuKIQPKK2J2zdt5LsMpYovdKIB72hIbJDSPqQ'
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
