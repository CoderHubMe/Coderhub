<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Login extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'users';
    }
    
    public function index() {
        // $_SESSION['userId'] = 4;
        if(isset($_SESSION['userId'])){
            redirect(); // redirects user back to the base page
        } else {
            $this->load->view('login/login.php');
        }
    }
}