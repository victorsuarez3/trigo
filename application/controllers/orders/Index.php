<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	private $page_config = array();
	public function __construct(){
		parent::__construct();
		$this->page_config = array(
	        'title' => "Listado de Órdenes",
	        'title_page' => "Órdenes",
	        'view_content' => "orders/index",
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
	}
	public function index()
	{
		$this->load->model('model_order');
		$data = array(
			'data' => $this->model_order->get_order_list()
		);
		$this->page_config += $data;
		$this->template->view($this->page_config);
	}
}