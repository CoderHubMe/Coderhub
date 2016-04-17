<?php
class Education_node_model extends MY_Model {
    
    public $belongs_to = array( 'user' );
    public $has_many = array( 'education_nodes' );
    
    public function __construct() {
        parent::__construct();
    }
}