<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {
	private $page_config = array();
	private $image_url = array();
	public function __construct(){
		parent::__construct();
		$this->page_config = array(
	        'title' => "Create new employee",
	        'title_page' => "Create new Employee",
	        'view_content' => "employees/create",
	        'css' => array(
	            'css/skins/_all-skins.min.css',
	            'css/style.css'
	        ),
	        'plugin_css' => array(
	            'datatables/dataTables.bootstrap.css',
	            'iCheck/square/blue.css'
	        ),
	        'plugin_js' => array(
	        	'fastclick/fastclick.js',
	        	'datatables/jquery.dataTables.min.js',
	        	'datatables/dataTables.bootstrap.min.js',
	        	'iCheck/icheck.min.js'
	        ),
	        'js' => array(
	            'js/app.min.js',
	            'js/demo.js',
	            'js/config/dataTables.js',
	            'js/config/iCheck.js'
	        ),
	        'sidebar_menu'=> true
	    );
	    $this->load->library("template");
	    $this->load->helper("form");
	    $this->load->library("form_validation");
	    $this->form_validation->set_error_delimiters('<section class="alert alert-danger">', '</section>');
	}
	public function index()
	{
	    $this->load->model(array('model_supplier', 'model_category'));
	    $data = array(
	        'address' => $this->model_address->get_addresses(),
    	    'department' => $this->model_department->get_departments(),
			'position' => $this->model_position->get_positions()    	        
	    );
	    $this->page_config += $data;
		$this->template->view($this->page_config);
	}
	public function confirm(){
	    $this->form_validation->set_rules('name', 'Nombre', 'callback_name_check');
	    $this->form_validation->set_rules('image_url', 'Imagen', 'callback_do_upload');
	    if ($this->form_validation->run() === FALSE){
	        $this->template->view($this->page_config);
	    }else{
	        $this->session->set_flashdata('error', true);
	        redirect('employee/create');
	    }
	}
	public function name_check($str){
	    $this->load->model('model_employee');
	    if ($this->model_employee->employee_name_validation($str)){
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	}
    public function do_upload()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
    
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image_url'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    return FALSE;
            }
            else
            {
                    $this->image_url = $this->upload->data();
                    
                    return $this->add_employee();
            }
    }
	public function add_employee(){
	    $this->load->model('model_employee');
	    $data = array(
	        'name' => $this->input->post('name'),
	        'last_name' => $this->input->post('last_name'),
			'telephone' => $this->input->post('telephone'),
			'cellphone' => $this->input->post('cellphone'),
			'email' => $this->input->post('email'),			
			'status' => $this->input->post('status'),
	        'image_url' => $this->image_url['file_name'],	        
	        'department_id' => $this->input->post('department'),
			'position_id' => $this->input->post('position'),
			'address_id' => $this->input->post('address'),
	        'start_date' => date('Y-m-d H:i:s')
	    );
	    if ($this->model_employee->insert_employee($data)){
	        $this->session->set_flashdata('employee_success',true);
	        redirect('employees');
	    }
	    return FALSE;
	}
}