<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employees extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
           exit(json_encode(array('error_code' => 500, 'error_message' => 'No direct script access allowed')));
        }
        $this->load->model('model_employee');
    }
    public function getall(){
        $data = array(
            'data' => $this->model_employee->get_employees()
        );
        $this->load->view('template/ajax/response', $data);
    }
    public function get($str){
        $data = array(
            'data' => $this->model_employee->get_employee($str)
        );
        $this->load->view('template/ajax/response', $data);
    }
    public function search(){
        $data = array(
            'data' => $this->model_employee->get_search_employee($this->input->post('search'))
        );
        $this->load->view('template/ajax/response', $data);
    }
}