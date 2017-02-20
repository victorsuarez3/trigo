<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_department extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function department_name_validation($str){
        $this->db->where('name', $str);
        $this->db->limit(1);
        $query = $this->db->get("department");
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function insert_department($data = array()){
        $this->db->insert('department', $data);
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_departments(){
        $query = $this->db->get('department');
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }
    public function department_id_isExisted($str){
        $this->db->where('id', $str);
        $query = $this->db->get('department');
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function update_department($data = array(), $str){
        $this->db->where('id', $str);
        $this->db->update('department', $data);
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_department($str){
        $this->db->limit(1);
        $this->db->where('id', $str);
        $query = $this->db->get('department');
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return NULL;
        }
    }
    public function delete_department($str){
	    $this->db->where("id", $str);
	    $this->db->delete('department');
	    if ($this->db->affected_rows() > 0){
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	}
}