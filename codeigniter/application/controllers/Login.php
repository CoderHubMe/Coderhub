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
        $this->load->model('company_model', 'company');
        
        if(isset($_POST['username'])) {
            $user = $this->user->with('company_admins')->get_by('username', $_POST['username']);
            if($user != null && password_verify($_POST['password'], $user->password)) {
                $data['login_success'] = true;
                $_SESSION['userId'] = isset($user->id)         ? $user->id : null;
                $_SESSION['username'] = isset($user->username) ? $user->username : '';
                $_SESSION['userEmail'] = isset($user->email)   ? $user->email : '';
                $_SESSION['user_fname'] = isset($user->fname)  ? $user->fname : '';
                $_SESSION['user_lname'] = isset($user->lname)  ? $user->lname : '';
                
                foreach($user->company_admins as $company_admin) {
                    $_SESSION['user_company_admin'][] = $this->company->get($company_admin->company_id);
                }
                
                
                
            } else {
                $data['login_success'] = false;
            }
        } else {
            $data['login_success'] = false;
        }
        $this->render_json($data);
    }
    
    public function register() {
        if(isset($_SESSION['userId'])){
            redirect(); // redirects user back to the base page
        } else {
            $this->load->view('login/register.php');
        }
    }
    
    public function register_action() {
        $this->load->library('form_validation');
        
        $validate_rules = array(
            array( 'field' => 'username', 
                   'label' => 'username',
                   'rules' => 'required|alpha|max_length[45]|is_unique[users.username]' ),
            array( 'field' => 'fname',
                   'label' => 'first name',
                   'rules' => 'required|alpha|max_length[45]' ),
            array( 'field' => 'lname',
                   'label' => 'last name',
                   'rules' => 'required|alpha|max_length[45]' ),
            array( 'field' => 'email', 
                   'label' => 'email',
                   'rules' => 'required|valid_email|is_unique[users.email]' ),
            array( 'field' => 'password', 
                   'label' => 'password',
                   'rules' => 'required|min_length[6]' ),
            array( 'field' => 'password-confirm', 
                   'label' => 'password-confirm',
                   'rules' => 'required|matches[password]',
                   'errors' => array(
                       'required' => 'Both password fields are required.',
                       'matches' => "Both passwords must match")
                    ),
        );
        $this->form_validation->set_rules($validate_rules);
        
        if(isset($_POST['username'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['password-confirm'])) {
            if($this->form_validation->run() !== FALSE) {
                $this->load->model('user_model', 'user');
                if($this->user->insert(array(
                    'username' => $_POST['username'],
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ))) {
                    $data['register_success'] = true;
                } 
            } 
        } 
        if(!isset($data['register_success']) || $data['register_success'] != true) {
            $data['register_success'] = false;
            $data['errors'] = $this->form_validation->error_array();
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