<?php
class Activity_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_many_by_like($field, $value) {
        $query = $this->db->select("*")->like($field, $value)->get("activities");
        return $query->result();
    }
    
    public function get_by_like($field, $value) {
        $query = $this->db->select("*")->like($field, $value)->limit(1)->get("activities");
        return $query->result();
    }
}