<?php

class Activity_model extends MY_Model {
    private $id;
    private $name;
    private $dateTime;
    private $typeId;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($value) {
        $this->id = $value;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($value) {
        $this->name = $value;
    }
    
    public function getDateTime() {
        return $this->dateTime;
    }
    
    public function setDateTime($value) {
        $this->dateTime = $value;
    }
    
    public function getTypeId() {
        return $this->typeId;
    }
    
    public function setTypeId($value) {
        $this->typeId = $value;
    }
    
    public static function createObjectFromData($row) {
        $activity = new Activity_model();
        $activity->setId($row->id);
        $activity->setName($row->name);
        $activity->setDateTime($row->date_time);
        $activity->setTypeId($row->type_id);
        return $activity;
    }
    
    public function getActivityById($id = 1) {
        $id = (int)$id;
        if($id > 0) {
            $query = $this->db->get_where("activity", array("id" => $id));
            if($query->num_rows() > 0) {
                return self::createObjectFromData($query->row());
            }
            // else
            return false;
        }
    }
    
    public static function getAllActivities($options = null) {
        $ci =& get_instance(); 
        $ci->db->select("*");
        $ci->db->from("activity");
        $query = $ci->db->get();
        if($query->num_rows() > 0) {
            $activities = array();
            foreach($query->result() as $row) {
                $activities[] = self::createObjectFromData($row);
            }
            return $activities;
        }
        return false;
    }
    
}