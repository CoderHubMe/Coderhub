<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Companies extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("company_model", "company");
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'companies';
    }
    
    public function index() {
        redirect('companies/show_all');
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