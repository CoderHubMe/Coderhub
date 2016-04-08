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
    
    public function login_action() {
        $this->load->model('user_model', 'user');
        
        if(isset($_POST['username'])) {
            $user = $this->user->get_by('username', 'pah9qd');
            if($user != null && password_verify($_POST['password'], $user->password)) {
                $data['login_success'] = true;
                $_SESSION['userId'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['userEmail'] = $user->email;
            } else {
                $data['login_success'] = false;
            }
        } else {
            $data['login_success'] = false;
        }
        $this->render_json($data);
    }
    
    public function logout() {
        // remove all session variables
        session_unset(); 
        
        // destroy the session 
        session_destroy(); 
        
        redirect();
    }
}