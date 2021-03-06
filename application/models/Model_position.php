<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_position extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function position_name_validation($str){
        $this->db->where('name', $str);
        $this->db->limit(1);
        $query = $this->db->get("position");
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function insert_position($data = array()){
        $this->db->insert('position', $data);
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_positions(){
        $query = $this->db->get('position');
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }
    public function position_id_isExisted($str){
        $this->db->where('id', $str);
        $query = $this->db->get('position');
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function update_position($data = array(), $str){
        $this->db->where('id', $str);
        $this->db->update('position', $data);
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_position($str){
        $this->db->limit(1);
        $this->db->where('id', $str);
        $query = $this->db->get('position');
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return NULL;
        }
    }
    public function delete_position($str){
	    $this->db->where("id", $str);
	    $this->db->delete('position');
	    if ($this->db->affected_rows() > 0){
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	}
}