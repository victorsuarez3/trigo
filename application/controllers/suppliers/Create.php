<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {
	private $page_config = array();
	public function __construct(){
		parent::__construct();
		$this->page_config = array(
	        'title' => "Agregar Suplidor",
	        'title_page' => "Agregar SUplidor",
	        'view_content' => "suppliers/create",
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
		$this->template->view($this->page_config);
	}
	public function confirm(){
	    $this->form_validation->set_rules('name', 'Nombre', 'callback_name_check');
	    if ($this->form_validation->run() === FALSE){
	        $this->template->view($this->page_config);
	    }else{
	        $this->session->set_flashdata('error', true);
	        redirect('supplier/create');
	    }
	}
	public function name_check($str){
	    $this->load->model('model_supplier');
	    if ($this->model_supplier->category_name_validation($str)){
	        return TRUE;
	    }else{
	        return $this->add_supplier();
	    }
	}
	public function add_supplier(){
	    $this->load->model('model_supplier');
	    $data = array(
	        'name' => $this->input->post('name'),
	        'email' => $this->input->post('email'),
	        'RNC' => $this->input->post('rnc'),
	        'contact_name' => $this->input->post('contact_name'),
	        'telephone' => $this->input->post('telephone'),
	        'cellphone' => $this->input->post('cellphone'),
	        'Details' => $this->input->post('details'),
	        'address' => array(
	            'address_line_1' => $this->input->post('address_1'),
	            'address_line_2' => $this->input->post('address_2'),
	            'number' => $this->input->post('number'),
	            'country' => $this->input->post('country'),
	            'state' => $this->input->post('state'),
	            'zip_code' => $this->input->post('zip_code')
	        )
	    );
	    if ($this->model_supplier->insert_supplier($data)){
	        $this->session->set_flashdata('supplier_success',true);
	        redirect('suppliers');
	    }
	    return FALSE;
	}
}