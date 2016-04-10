<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

<<<<<<< HEAD
class Admins extends MY_Controller {
=======
class Companies extends MY_Controller {
>>>>>>> origin/pah9qd_sprint2
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model", "admin");
        $this->load->helper("url_helper");
        
<<<<<<< HEAD
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
=======
        $this->theme_options['menu'] = 'companies';
    }
    
    public function index() {
        redirect('users/show');
    }
    
    public function show($companyId = 0) {
        $companyId = (int)$companyId;
        
        $data = $this->company->get($companyId);
        if($data != null) {
            $this->theme_options['title'] = $data->name . " Profile";
            $this->theme_options['subtitle'] = "A really Cool Company";
            $this->theme_options['breadcrumbs'] = array(
                'Home' => base_url(),
                'Companies' => base_url('companies'),
                "{$data->name}" => base_url('companies/show/'.$data->id));
            $this->set_var('theme', $this->theme_options);
            $this->set_var('company', $data);
            $this->render();
        } else {
            redirect('companies/show_all');
        }
    }
    
    public function show_all() {
        $data = $this->company->get_all();
        $this->theme_options['title'] ="List of Companies";
        $this->theme_options['subtitle'] = '';
        $this->theme_options['breadcrumbs'] = array(
                'Home' => base_url(),
                'Companies' => base_url('companies'));
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('companies', $data);
        $this->render();
    }
    
}
>>>>>>> origin/pah9qd_sprint2
