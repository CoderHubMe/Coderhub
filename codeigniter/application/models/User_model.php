<?php

class User_model extends CI_MODEL {
    private $_id;
    private $_fname;
    private $_lname;
    private $_username;
 
    function __construct() {
        $this->load->database();
    }    
    
    public function getId() {
        return $this->_id;
    }
    
    public function setId($value) {
        $this->_id = $value;
    }
    
    public function getFname() {
        return $this->_fname;
    }
    
    public function setFname($value) {
        $this->_fname = $value;
    }
    
    public function getLname() {
        return $this->_lname;
    }
    
    public function setLname($value) {
        $this->_lname = $value;
    }
    
    public function getUsername() {
        return $this->_username;
    }
    
    public function setUsername($value) {
        $this->_username = $value;
    }
    
    public function commit() {
        $data = array(
            'fname' => $this->_fname,
            'lname' => $this->_lname,
            'username' => $this->_username
        );
        
        if($this->_id = 0) {
            if($this->db->update("user", $data, array("id" => $this->_id))) {
                return true;
            }
        } else {
            if($this->db->insert("user", $data)) {
                $this->_id = $this->db->insert_id();
                return true;
            }
        }
        return false;
    }
}