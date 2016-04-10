<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");


class Admin extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        
        // Block access to class for all non-admins
        if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            redirect();
        }
        
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'admin';
    }

    public function show_all_users() {
        $this->load->model('user_model', 'user');
        $data = $this->user->get_all();
        $this->theme_options = array_merge($this->theme_options, array(
            'title' => 'Administrate All Users', 
            'subtitle' => 'With great power comes great responsiblity', 
            'breadcrumbs' => array(
                'Admin All Users' => 'admin/show_all_users')
            )
        );
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('users', $data);
        $this->render();
    }
    
    public function edit_user($userId = null) {
        if($userId == null) {
            redirect('admin/show_all_users');
        }
        $userId = (int)$userId;
        
        $this->load->model('user_model', 'user');
        $data = $this->user->get($userId);
        
        $this->theme_options = array_merge($this->theme_options, array(
            'title' => 'Edit User',
            'subtitle' => 'Be Nice Please',
            'breadcrumbs' => array(
                'Admin All Users' => 'admin/show_all_users',
                'Edit '.$data->username => 'admin/edit_user/'.$data->id)
            )
        );
        
        $this->add_script('plugins/input-mask/jquery.inputmask.js');
        $this->add_script('plugins/input-mask/jquery.inputmask.date.extensions.js');
        $this->add_script('plugins/input-mask/jquery.inputmask.extensions.js');
        $this->add_script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js');
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('user', $data);
        $this->render();
    }
    
}
