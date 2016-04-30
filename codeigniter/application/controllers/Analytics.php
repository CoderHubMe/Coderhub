<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Analytics extends MY_Controller {
    
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model("analytics_model", "analytics");
        $this->load->helper("url_helper");
        
        $this->theme_options['menu'] = 'users';
    }
    
    public function index() {
        echo "This is the index!";
    }
    
   public function skillsChart() {
       if($databaseResult = $this->analytics->skillsChartQuery()) {
           foreach($databaseResult as $row) {
               $result['labels'][] = $row->name;
               $result['data'][] = $row->count;
               $result['colors'][] = "rgb(" . rand(0, 255). "," . rand(0, 255) . "," . rand(0, 255) . ")";
           }
           $result['success'] = true;
       } else {
           $result['success'] = false;
       }
       $this->render_json($result);
   }
   
   public function connAndBlockedConnOverTime() {
       if($databaseResult = $this->analytics->connAndBlockedConnOverTime()) {
           foreach($databaseResult as $row) {
               $result['labels'][] = $row->monthname . ' ' . $row->year;
               $result['accepted_data'][] = $row->count_accepted;
               $result['blocked_data'][] = $row->count_blocked;
           }
           $result['success'] = true;
       } else {
           $result['success'] = false;
       }
       $this->render_json($result);
   }
}