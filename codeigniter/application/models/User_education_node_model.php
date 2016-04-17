<?php
class User_education_node_model extends MY_Model {
    
    public $belongs_to = array( 'user_education_node' );
    
    public function __construct() {
        parent::__construct();
    }
}