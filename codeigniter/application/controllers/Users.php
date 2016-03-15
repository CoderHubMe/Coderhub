<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Users extends CI_CONTROLLER {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->helper("url_helper");
        $this->load->library("user_factory");
    }
    
    public function index() {
        echo "This is the index!";
    }
    
    public function show($userId = 0) {
        $userId = (int)$userId;
        $data = array(
            "users" => $this->user_factory->getUser($userId)
        );
        if($data['users']) {
            $this->load->view("templates/header", $data);
            $this->load->view("users/show_users", $data);
            $this->load->view("templates/footer", $data);
        } else {
            show_404();
        }
    }
}

// first comment