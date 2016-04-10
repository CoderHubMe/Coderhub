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
        array( 'field' => 'birthday',
              'label' => 'birthday',
              'rules' => '')
    );
    
    public function __construct() {
        parent::__construct();
    }
}