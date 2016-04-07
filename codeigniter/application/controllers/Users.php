<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Users extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'user';
    }
    
    public function index() {
        echo "This is the index!";
    }
    
    public function show($userId = 0) {
        
    }
    
    public function show_resume($userId = 0) {
        $userId = (int)$userId;
        
        $this->theme_options['breadcrumbs'] = array(
            'Home' => base_url(), 
            'Users' => base_url('users'),
            'Resume' => base_url('users/show_resume'));
        $this->theme_options['title'] = 'User Resume';
        $this->theme_options['subtitle'] = '';
        
        if(!is_int($userId)) {
            show_404();
        } else {
            $data = $this->user->get($userId);
            $this->set_var('theme', $this->theme_options);
            $this->set_var('user_data', $data);
            $this->render();
        }
    }
}

// first comment