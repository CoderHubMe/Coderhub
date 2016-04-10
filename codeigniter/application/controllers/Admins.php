<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Admins extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model", "admin");
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'admins';
    }
    
    public function index() {
        $this->render();
    }
    
    public function show_users() {
        $data = $this->user->get_all();
        $this->render();
    }
}

// first comment