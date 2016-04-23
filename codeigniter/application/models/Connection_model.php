<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connection_model extends MY_Model {
    
    public $has_many = array();
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function requestor_or_connection($requestor, $connection) {
        $this->_database
            ->from('connections')
            ->group_start()
                ->where('user_id_requestor', $requestor)
                ->where('user_id_connection', $connection)
            ->group_end()
            ->or_group_start()
                ->where('user_id_requestor', $connection)
                ->where('user_id_connection', $requestor)
            ->group_end();
        
        $result = $this->_database->get()->{$this->_return_type()}();
        return $result;
    }
    
    
}