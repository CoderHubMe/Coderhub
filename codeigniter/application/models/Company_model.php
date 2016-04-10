<?php
class Company_model extends MY_Model {
    
    public $validate = array(
        array( 'field' => 'name', 
              'label' => 'name',
              'rules' => 'required|max_length[50]' ),
        array( 'field' => 'street_address',
              'label' => 'first name',
              'rules' => 'required|max_length[100]' ),
        array( 'field' => 'owner',
              'label' => 'owner',
              'rules' => 'required|alpha_numeric_spaces|max_length[45]' ),
    );
    
    public function __construct() {
        parent::__construct();
    }
}