<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    
    public $has_many = array('company_admins');
    
    public $validate = array(
        array( 'field' => 'username', 
              'label' => 'username',
              'rules' => 'alpha_numeric|max_length[45]' ),
        array( 'field' => 'fname',
              'label' => 'first name',
              'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'lname',
              'label' => 'last name',
              'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'email', 
              'label' => 'email',
              'rules' => 'valid_email' ),
        array( 'field' => 'password', 
              'label' => 'password',
              'rules' => 'min_length[10]' ),
        array( 'field' => 'github_username',
                'label' => 'github username',
                'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'auth_token',
                'label' => 'token',
                'rules' => 'alpha_numeric|max_length[45]' ),
        array( 'field' => 'profile_image_url',
                'label' => 'profile image',
                'rules' => 'max_length[100]' ),
        array( 'field' => 'description',
                'label' => 'description',
                'rules' => 'max_length[65535]' ),        
        // array( 'field' => 'birthday',
        //       'label' => 'birthday',
        //       'rules' => 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]')
    );
    
    public function __construct() {
        parent::__construct();
    }
}