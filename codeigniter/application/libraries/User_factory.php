<?php

if( ! defined("BASEPATH")) exit("No direct script access allowed");

class User_factory {
    private $_ci;
    
    function __construct() {
        $this->_ci =& get_instance();
        $this->_ci->load->model("user_model");
    }
    
    public function getUser($id = 0) {
        if($id > 0) {
            // Get an idividual user
            $query = $this->_ci->db->get_where("user", array("id" => $id));
            if($query->num_rows() > 0) {
                return $this->createObjectFromData($query->row());
            }
            return false;
        } else {
            // Get all users
            $query = $this->_ci->db->select("*")->from("user")->get();
            if($query->num_rows() > 0) {
                $users = array();
                foreach($query->result() as $row) {
                    $users[] = $this->createObjectFromData($row);
                }
                return $users;
            }
            return false;
        }
    }
    
    public function createObjectFromData($row) {
        $user = new User_model();
        $user->setId($row->id);
        $user->setFname($row->fname);
        $user->setLname($row->lname);
        $user->setUsername($row->username);
        return $user;
    }
}