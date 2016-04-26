<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Users extends MY_Controller {
    
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'users';
    }
    
    public function index() {
        echo "This is the index!";
    }
    
    public function authorize() {
        $this->load->view('users/authorize.php');
    }
    
    public function profile($userId = 0) {
        if($userId === 0) {
            redirect();
        }
        $userId = (int)$userId;
        $data = $this->user->get_everything($userId);
        $this->theme_options = array_merge($this->theme_options, array(
            'title' => '',
            'subtitle' => '',
            'breadcrumbs' => array(
                'Users' => base_url("users/find_users"),
                $data->fname . ' ' . $data->lname => base_url("users/profile/" . $data->id)
                )
            )
        );
        
        $this->set_var("theme", $this->theme_options);
        $this->set_var("user", $data);
        // var_dump($data);
        $this->render();
    }
    
    
    
    public function show_resume() {
        if(!isset($_SESSION['userId'])) {
            redirect();
        }
        else {
            $userId = (int)$_SESSION['userId'];
            
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
    
    public function edit_action($userId = null) {
        if($userId != null) {
            $userId = (int)$userId;
            
            if($userId == $_SESSION['userId'] || $_SESSION['is_admin'] == 1) {
                
                $this->load->library('form_validation');
                $validate_rules = array(
                    array( 'field' => 'username', 
                           'label' => 'username',
                           'rules' => 'required|alpha_numeric|max_length[45]' ),
                    array( 'field' => 'fname',
                           'label' => 'first name',
                           'rules' => 'required|alpha|max_length[45]' ),
                    array( 'field' => 'lname',
                           'label' => 'last name',
                           'rules' => 'required|alpha|max_length[45]' ),
                    array( 'field' => 'email', 
                           'label' => 'email',
                           'rules' => 'required|valid_email' ),
                );
                $this->form_validation->set_rules($validate_rules);
                if($this->form_validation->run() !== FALSE) {
                    $updateUserData = array(
                        'username' => $_POST['username'],
                        'fname' => $_POST['fname'],
                        'lname' => $_POST['lname'],
                        'email' => $_POST['email'],
                        'birthday' => $_POST['birthday'],
                        'github_username' => $_POST['github_username']
                    );  
                    if($_SESSION['is_admin'] == 1) {
                        $updateUserData['is_admin'] = (int)$_POST['is_admin'];
                    }
                    
                    if($this->user->update($userId, $updateUserData)) {
                        $data['edit_success'] = true;
                    }
                }
            }
        }
        
        if(!isset($data['edit_success']) || $data['edit_success'] != true) {
            $data['edit_success'] = false;
            $data['errors'] = $this->form_validation->error_array();
        }
        
        $this->render_json($data);
    }
    
    public function find_users($search = 'null', $offset = 0, $limit = 15) {
        if($search === '' || $search === 'null') {
            $data = $this->user->limit($limit, $offset)->get_all();
        } else {
            $data = $this->user->limit($limit, $offset)->search($search, array('fname', 'lname', 'email'))->get_all();
        }
        $this->set_var('theme', $this->theme_options);
        $this->set_var('users', $data);
        $this->render();
    }
}

// first comment