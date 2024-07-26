<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Module_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('module_model');
        
        // Cache control
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->$config['module_name'] = 'Opportunities';
    }

    // Default function, redirects to login page if no admin logged in yet
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url() . 'index.php?login', 'refresh');
        }
        if ($this->session->userdata('admin_login') == 1) {
            redirect(base_url() . 'index.php?Module_Controller/dashboard', 'refresh');
        }
    }

    // Admin Dashboard
    public function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = 'Dashboard';
        $modules_data = json_decode(json_encode($this->fetchModuleData("GET", '/module/' . $this->$config['module_name'])), true);
        $vardefsAndViewdefs = json_decode(json_encode($this->fetchModuleData("GET", '/custom/module/' . $this->$config['module_name'])), true);
        if (empty($vardefsAndViewdefs['error'])){     
            $listviewArray = [];
            $list = [];
            foreach ($modules_data['data'] as $moduleData) {
                        $listviewArray['id'] = $moduleData['id'];
                foreach ($vardefsAndViewdefs['viewdefs']['ListView'] as $fieldKey => $fieldDef) {
                    if (array_key_exists(strtolower($fieldKey),$moduleData['attributes']) && $fieldDef['default'] == '1') {
                        $listviewArray[$fieldKey] = $moduleData['attributes'][strtolower($fieldKey)];
                    }
                }
                $list[] = $listviewArray;
            }
            $page_data['modules_data'] = $list;
            $page_data['modules_key'] = array_keys($list[0]);
        }else{
            $page_data['modules_data'] = '';
            $page_data['modules_key'] = '';
        }


        $this->load->view('backend/index', $page_data);
    }

    private function fetchModuleData($methodName = '', $url = '', $body = '')
    {     

        // echo "<pre>";print_r($url.'<br>'.$body.'<br>'.$methodName);die();

        return $this->module_model->postApi($methodName,$url,$body);
    }

    public function view()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($segments);
        
        $url = '/module/' . $this->$config['module_name'] . '/' . $module_id;

        if ($this->session->userdata('admin_login') != 1) {
        redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'view_module';
        $page_data['page_title'] = 'Detail View';
        $page_data['vardefsAndViewdefs'] = json_decode(json_encode($this->fetchModuleData("GET", '/custom/module/' . $this->$config['module_name'])), true);

        $modules_data = $this->fetchModuleData("GET", $url);
        $attributesArray = json_decode(json_encode($modules_data->data->attributes), true);
        $labels = $page_data['vardefsAndViewdefs']['labels'];
        $detailViewDefs = $page_data['vardefsAndViewdefs']['viewdefs']['DetailView']['panels'];

        $visibleFieldArray = [];   #------------------------------- THIS IS FOR CHETGPT ---------------
        // Iterate through each section in $detailViewDefs
        foreach ($detailViewDefs as $section) {
            if (is_array($section)) {
                // Iterate through each set of fields within the section
                foreach ($section as $fields) {
                    if (is_array($fields)) {
                        // Check if the fields are arrays of fields
                        foreach ($fields as $field) {
                            if (is_array($field) && isset($field['name'])) {
                                // Add the 'name' to the visibleFieldArray
                                $visibleFieldArray[$field['name']] = $field['name'];
                            } elseif (is_string($field)) {
                                // Handle cases where fields are simple strings (like 'date_entered', 'date_modified')
                                $visibleFieldArray[$field] = $field;
                            }
                        }
                    }
                }
            }
        }

        $data = '';
        foreach ($attributesArray as $key => $value) {
            if (!array_key_exists($key,$visibleFieldArray)) { continue;}
            $label = isset($labels[$key]) ? $labels[$key] : ucfirst(str_replace("_", " ", $key));
            $data .= '<tr style="width:50%"><th>' . $label . ':</th><td>' . $value . '</td></tr>';
        }
        $page_data['modules_data'] = $data;
        $page_data['moduleId'] = $module_id;
        $this->load->view('backend/index', $page_data);
    }

    public function create()
    {
        if ($this->session->userdata('admin_login') != 1) {
        redirect(base_url(), 'refresh');
        }
        if (!empty($_POST)) {
            $url = '/module';
            $body = [
                'data' => [
                    'type' => $this->$config['module_name'],
                    'attributes' => $_POST
                ]
            ];
            $module_id = $this->fetchModuleData("POST", $url, $body)->data->id;
            if (empty($module_id)) {
                $this->session->set_flashdata('flash_error_message' , 'create error...');
                redirect(base_url() . 'index.php?Module_Controller/dashboard');
            }
            $this->session->set_flashdata('flash_message' , get_phrase('Record created...'));
            redirect(base_url() . 'index.php?Module_Controller/view/' . $module_id);
        }

        $vardefsAndViewdefs = json_decode(json_encode($this->fetchModuleData("GET", '/custom/module/' . $this->$config['module_name'])), true);

        $fields_Types_array = [];
        $fieldHtml = '';

        $detailViewDefs = $vardefsAndViewdefs['viewdefs']['EditView']['panels'];

        $visibleFieldArray = [];
        // Iterate through each section in $detailViewDefs
        foreach ($detailViewDefs as $section) {
            if (is_array($section)) {
                // Iterate through each set of fields within the section
                foreach ($section as $fields) {
                    if (is_array($fields)) {
                        // Check if the fields are arrays of fields
                        foreach ($fields as $field) {
                            if (is_array($field) && isset($field['name'])) {
                                // Add the 'name' to the visibleFieldArray
                                $visibleFieldArray[$field['name']] = $field['name'];
                            } elseif (is_string($field)) {
                                // Handle cases where fields are simple strings (like 'date_entered', 'date_modified')
                                $visibleFieldArray[$field] = $field;
                            }
                        }
                    }
                }
            }
        }

        foreach ($vardefsAndViewdefs['vardefs'] as $fieldName => $fieldType) {

            if (!array_key_exists($fieldName,$visibleFieldArray) || $fieldName == 'id') { continue;}
            $label = isset($vardefsAndViewdefs['labels'][$fieldName]) ? $vardefsAndViewdefs['labels'][$fieldName] : ucfirst(str_replace("_", " ", $fieldName));
            
            if ($fieldType['type'] == 'enum') {
                $fieldHtml = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label>';
                $fieldHtml .= '<select class="form-control" id="' . $fieldName . '" name="' . $fieldName . '">';
                
                foreach ($vardefsAndViewdefs['dropdowns'][$fieldType['options']] as $optionKey => $optionValue) {
                    $fieldHtml .= '<option value="' . $optionKey . '">' . $optionValue . '</option>';
                }
                $fieldHtml .= '</select>';
                $fieldHtml .= '</div>';
            } elseif($fieldType['type'] == 'datetime' || $fieldType['type'] == 'date') {
                $fieldHtml = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label><input type="date" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"></div>';
            } else {
                $fieldHtml = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label><input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '"></div>';
            }

            $fields_Types_array[$fieldName] = $fieldHtml;
        }

        $data = implode('', $fields_Types_array);
        $page_data['modules_data'] = $data;
        $page_data['page_name'] = 'edit_module';
        $page_data['page_title'] = 'Create View';
        $this->load->view('backend/index', $page_data);
    }

    public function edit()
    {
        if ($this->session->userdata('admin_login') != 1) {
        redirect(base_url(), 'refresh');
        }

        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($segments);
        $url = '/module/' . $this->$config['module_name'] . '/' . $module_id;

        if (!empty($_POST)) {
            $url = '/module';

            $body = [
                'data' => [
                    'type' => $this->$config['module_name'],
                    'id' => $module_id,
                    'attributes' => $_POST
                ]
            ];

            $responseId = $this->fetchModuleData("PATCH", $url, $body)->data->id;
                    // echo "<pre>";print_r($responseId);die();
            if (!empty($responseId)) {
                $this->session->set_flashdata('flash_message' , get_phrase('Record updated...'));
                redirect(base_url() . 'index.php?Module_Controller/view/' . $module_id);
            }else{
                $this->session->set_flashdata('flash_error_message' , 'updated error...');
            }
            redirect(base_url() . 'index.php?Module_Controller/dashboard');
        }

        $page_data['page_name'] = 'edit_module';
        $page_data['page_title'] = 'Edit View';
        $page_data['moduleId'] = $module_id;

        $modules_data = $this->fetchModuleData("GET", $url);
        $vardefsAndViewdefs = json_decode(json_encode($this->fetchModuleData("GET", '/custom/module/' . $this->$config['module_name'])), true);
        $attributesArray = json_decode(json_encode($modules_data->data->attributes), true);

        $fields_Types_array = [];
        $fieldHtml = '';


        $detailViewDefs = $vardefsAndViewdefs['viewdefs']['EditView']['panels'];

        $visibleFieldArray = [];


        // Iterate through each section in $detailViewDefs
        foreach ($detailViewDefs as $section) {
            if (is_array($section)) {
                // Iterate through each set of fields within the section
                foreach ($section as $fields) {
                    if (is_array($fields)) {
                        // Check if the fields are arrays of fields
                        foreach ($fields as $field) {
                            if (is_array($field) && isset($field['name'])) {
                                // Add the 'name' to the visibleFieldArray
                                $visibleFieldArray[$field['name']] = $field['name'];
                            } elseif (is_string($field)) {
                                // Handle cases where fields are simple strings (like 'date_entered', 'date_modified')
                                $visibleFieldArray[$field] = $field;
                            }
                        }
                    }
                }
            }
        }
        foreach ($vardefsAndViewdefs['vardefs'] as $fieldName => $fieldType) {
            if (!array_key_exists($fieldName,$visibleFieldArray) || $fieldName == 'id') { continue;}
            $label = isset($vardefsAndViewdefs['labels'][$fieldName]) ? $vardefsAndViewdefs['labels'][$fieldName] : ucfirst(str_replace("_", " ", $fieldName));
            
            if ($fieldType['type'] == 'enum') {
                $fieldHtml = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label>';
                $fieldHtml .= '<select class="form-control" id="' . $fieldName . '" name="' . $fieldName . '">';
                
                foreach ($vardefsAndViewdefs['dropdowns'][$fieldType['options']] as $optionKey => $optionValue) {
                    $selected = (isset($attributesArray[$fieldName]) && $attributesArray[$fieldName] == $optionKey) ? 'selected' : '';
                    $fieldHtml .= '<option value="' . $optionKey . '" ' . $selected . '>' . $optionValue . '</option>';
                }
                $fieldHtml .= '</select>';
                $fieldHtml .= '</div>';

                $fields_Types_array[$fieldName] = $fieldHtml;
            }elseif($fieldType['type'] == 'datetime' || $fieldType['type'] == 'date') {
                $value = isset($attributesArray[$fieldName]) ? $attributesArray[$fieldName] : '';
                $fields_Types_array[$fieldName] = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label><input type="date" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $value . '"></div>';
            } else {
                $value = isset($attributesArray[$fieldName]) ? $attributesArray[$fieldName] : '';
                $fields_Types_array[$fieldName] = '<div class="form-group" style="width:50%"><label for="' . $fieldName . '">' . $label . ':</label><input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $value . '"></div>';
            }
        }
        $data = implode('', $fields_Types_array);
        $page_data['modules_data'] = $data;

        $this->load->view('backend/index', $page_data);
    }

    public function delete()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($segments);
        $url = '/module/' . $this->$config['module_name'] . '/' . $module_id;
        
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $response = $this->fetchModuleData("DELETE", $url);
        if (empty($response->data)){
            $this->session->set_flashdata('flash_message' , get_phrase('Record deleted...'));
        }else{
            $this->session->set_flashdata('flash_error_message' , 'Deleting error...');
        }

        redirect(base_url() . 'index.php?Module_Controller/dashboard');
    }
}
