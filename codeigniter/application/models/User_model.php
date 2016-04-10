<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    
    public $validate = array(
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
              'rules' => 'required|min_length[10]' ),
    );
    
    public function __construct() {
        parent::__construct();
    }
}