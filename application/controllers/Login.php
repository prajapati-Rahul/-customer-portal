<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Farid Ahmed
 *	date		: 27 september, 2015
 *	SIgnetBD
 *	efarid08@gmail.com
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('module_model');
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?Module_Controller/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }
        //Replying ajax request with validation response
        echo json_encode($response);
    }

    function validate_login($email = '', $password = '') {

        $body = array(
            'userName' => $email,
            'Password' => $password
        );
        $url = '/login_user';
        $header = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhYmViMTBlZC1kNjQ3LTAzNzYtMTVkOC02NTdjMjQ2YjI3YzkiLCJqdGkiOiJmNjA5OWY2NjJlODJiNzk5MTg0YTk0ZDNkNjY5Y2UyY2U3NzMyODlmYWZhYzg0YjM0NDE3MjU0MjllNTQ0ZmY1NjkwMzI2ZGY5ZTljMWMxZCIsImlhdCI6MTcyMTcxMjE1NS4yOTAwMTgwODE2NjUwMzkwNjI1LCJuYmYiOjE3MjE3MTIxNTUuMjkwMDIwOTQyNjg3OTg4MjgxMjUsImV4cCI6MTcyMTcxNTc1Mi4yNjc4NDM5NjE3MTU2OTgyNDIxODc1LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.WRVPTpFoi9zcMT3bIoGk26cyEFPEYcuiRQNqqyo_qWhS2XqMYjTyVHu26lMzkSIyepGoXruhVjvyPz1hBx0txON9XyakxFofomnBwW8S_soi29Jy7JgNrKZOjio6A9qxN3KcHiPlSLXGnF0VPOwjHFgmjcCKCPos9d_QZzhW94FV3BkrAXS1sSbE4RWtKgpz9Prb3FnZFJRWsdNMV-qM3w7W3avnp42Wu4zEJFX6JD81s1xCENo2xpwHRgWHwjrMKrwca4etVLCha9o9rFBHGthB9g2v4ac4VjMQgHMXBmjBRteYTTRXToDRbjDZS0zYZ0Dj8Om0nx82amVdzlEM3w',
            'Cookie: sugar_user_theme=SuiteP'
        );
        $responseArray = $this->module_model->postApi($body ,$url ,$header);

        $this->session->set_userdata('admin_login', '1');
        $this->session->set_userdata('admin_id', $response->admin_id);
        $this->session->set_userdata('login_user_id', $response->admin_id);
        $this->session->set_userdata('name', $response->name);
        $this->session->set_userdata('login_type','admin');
        return 'success';

        // set login credential of session
        // if ($query->num_rows() > 0) {
        //     $row = $query->row();
        //     $this->session->set_userdata('admin_login', '1');
        //     $this->session->set_userdata('admin_id', $row->admin_id);
        //     $this->session->set_userdata('login_user_id', $row->admin_id);
        //     $this->session->set_userdata('name', $row->name);
        //     $this->session->set_userdata('login_type', 'admin');
        //     return 'success';
        // }
        return 'invalid';
    }

    function ajax_forgot_password()
    {
        // $resp['submitted_data'] = $_POST;
        // echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
