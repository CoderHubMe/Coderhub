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
    
    public function edit($companyId = null) {
        if($companyId == null) {
            redirect();
        }
        $companyId = (int)$companyId;
        $data = $this->company->get($companyId);
        if($data == null) {
            // Something
        } else {
            $this->load->model('company_admin_model', 'company_admins');
            $companyAdmin = $this->company_admins->get_by(array('company_id' => $companyId, 'user_id' => $_SESSION['userId']));
            if($companyAdmin == null) {
                redirect();
            } else {
                $this->theme_options['title'] = 'Edit Company Profile';
                $this->theme_options['subtitle'] = '';
                $this->theme_options['breadcrumbs'] = array(
                    'Companies' => base_url('companies/show_all'),
                    'Edit ' . $data->name => base_url('companies/edit/' . $data->id)
                );
                $this->set_var('theme', $this->theme_options);
                $this->set_var('company', $data);
                $this->render();
            }
        }
    }
    
    public function edit_action($companyId = null) {
        if($companyId == null) {
            // Go Away!
        } 
        $this->load->model('company_admin_model', 'company_admins');
        $companyAdmin = $this->company_admins->get_by(array('company_id' => $companyId, 'user_id' => $_SESSION['userId']));
        if($companyAdmin == null) {
            // Go Away, not allowed!
        }
        $companyId = (int)$companyId;
        if($this->company->update($companyId, array(
            'name' => $_POST['name'],
            'street_address' => $_POST['street_address'],
            'owner' => $_POST['owner']
        ))) {
            $data['edit_success'] = true;
        }
        
        if(!isset($data['edit_success']) || $data['edit_success'] != true) {
            $data['edit_success'] = false;
            $data['errors'] = $this->form_validation->error_array();
        }
        
        $this->render_json($data);
    }
    
    public function create(){
        $this->theme_options['title'] = 'Create a Company';
        $this->theme_options['subtitle'] = '';
        $this->theme_options['breadcrumbs'] = array(
            'Companies' => base_url('companies/show_all'),
            'Create' => base_url('companies/create/')
        );
        
        $this->set_var('theme', $this->theme_options);
        $this->render();
    }
    
    public function create_action() {
        $insertData = array(
            'name' => $_POST['name'],
            'street_address' => $_POST['street_address'],
            'owner' => $_POST['owner']
        );
        
        if($newCompanyId = $this->company->insert($insertData)) {
            $this->load->model('company_admin_model', 'company_admins');
            $this->company_admins->insert(array('user_id' => $_SESSION['userId'], 'company_id' => $newCompanyId));
            array_push($_SESSION['user_company_admin'], (object)array(
                'id' => $newCompanyId,
                'name' => $_POST['name'],
                'street_address' => $_POST['street_address'],
                'owner' => $_POST['owner']
            ));
            $data['newCompanyId'] = $newCompanyId;
            $data['create_success'] = true;
        }
        
        if(!isset($data['create_success']) || $data['create_success'] != true) {
            $data['create_success'] = false;
            $data['errors'] = $this->form_validation->error_array();
        }
        
        $this->render_json($data);
    }
    
    // public function delete_action() {
    //     $
    // }
    
}