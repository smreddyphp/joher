<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mobile_services extends CI_Model 
	{
	    public function registarUser($data)
	    {
	        $this->db->insert('users',$data);
	        return true;
	    }
	    
	    public function check($table,$data)
	    {
	        $this->db->where($data);
	        $record = $this->db->get($table);
	        return $record;
	    }
	    
	    public function update($table,$where,$data)
	    {
	        $this->db->where($where);
	        $this->db->update($table,$data);
	        return true;
	    }
	    
	}
	