<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skill_model extends MY_Model {
    
    public $validate = array(
        array( 'field' => 'name', 
              'label' => 'Name',
              'rules' => 'alpha_numeric|max_length[45]' ),
        array( 'field' => 'description',
              'label' => 'Description',
              'rules' => 'alpha_numeric'),
    );
    public function __construct() {
        parent::__construct();
    }
}