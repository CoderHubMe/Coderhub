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
            'title' => 'All Users', 
            'subtitle' => 'With great power comes great responsiblity', 
            'breadcrumbs' => array(
                'Admin All Users' => base_url('admin/show_all_users'))
            )
        );
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('users', $data);
        $this->render();
    }
    
    public function show_all_skills() {
        $this->load->model('skill_model', 'skill');
        $data = $this->skill->get_all();
        $this->theme_options = array_merge($this->theme_options, array(
            'title' => 'All Skills', 
            'subtitle' => 'With great power comes great responsiblity', 
            'breadcrumbs' => array(
                'All Skills' => '../admin/show_all_skills')
            )
        );
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('skills', $data);
        $this->render();
    }
    
    public function edit_user($userId = null) {
        if($userId == null) {
            redirect('../admin/show_all_users');
        }
        $userId = (int)$userId;
        
        $this->load->model('user_model', 'user');
        $data = $this->user->get($userId);
        
        $this->theme_options = array_merge($this->theme_options, array(
            'title' => 'Edit User',
            'subtitle' => 'Be Nice Please',
            'breadcrumbs' => array(
<<<<<<< HEAD
                'All Users' => '../edit_user/',
                'Edit '.$data->username => '../edit_user/'.$data->id)
=======
                'Admin All Users' => base_url('admin/show_all_users'),
                'Edit '.$data->username => base_url('admin/edit_user/'.$data->id)
>>>>>>> 2df50b6b10b9657563e192eb2a855c853adb6f65
            )
        ));
        
        $this->add_script('plugins/input-mask/jquery.inputmask.js');
        $this->add_script('plugins/input-mask/jquery.inputmask.date.extensions.js');
        $this->add_script('plugins/input-mask/jquery.inputmask.extensions.js');
        
        $this->set_var('theme', $this->theme_options);
        $this->set_var('user', $data);
        $this->render();
    }
    
    public function delete_user_action($userId = null) {
        if($userId == null) {
            redirect('admin/show_all_users');
        }
        $userId = (int)$userId;
        
        if($userId == $_SESSION['userId'] || $_SESSION['is_admin'] == 1) {
            $this->load->model("user_model", 'user');
            if($this->user->delete($userId)) {
                if($userId == $_SESSION['userId']) {
                    redirect('login/logout');
                } else {
                    redirect('admin/show_all_users');
                }
            }
            
        }
        
    }
    
}
