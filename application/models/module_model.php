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
                    'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiJjYjI3MzgzODk2MDdiZGUwNTNmNGIzZWM4ZTA3MjYyZTM0Zjg4MjY5M2U0M2VmNmRmMGI1YzE2ZDE2Mzg3MDk5ZmEyNGY0MWExMjMyMzNlMSIsImlhdCI6MTcyMTk4OTcyNi40ODAxMDExMDg1NTEwMjUzOTA2MjUsIm5iZiI6MTcyMTk4OTcyNi40ODAxMDMwMTU4OTk2NTgyMDMxMjUsImV4cCI6MTcyMTk5MzMyNi4xOTY1MzUxMTA0NzM2MzI4MTI1LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.X1-1dCc7fRT90Y7pE-htVUPEetA5MgtG0Cb2n_r3b1b_ZXUEe_H9QjiBnvNpF36lbOVMN1I3Y6ZFjhAcHtrE4MzsM8vJlhx5qom-NpeRl-0durpPFJ7fuAQ9wG_3_rC94G_Hcs6xJPHN5vBdf3uXqcNvHdvSSnvbATNsJqe3U7-icUCibLtLSVIV2XvJfxtgpWPq95MfUNQd8IrPuE9h-me_GAJ8C-XZjXveLh2a__LH7tr4ngzfgvFac-UU66krCE88Q_LLsH4I4fEHVd8wTcLN4WutvRUzcXyGlO-A3Bf5276qg85BdAKGzYpmFi9KushFeDMkfXbSOdr0carafQ'
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
