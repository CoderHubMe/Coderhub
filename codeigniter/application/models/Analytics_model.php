<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function skillsChartQuery() {
        $result = $this->_database
            ->select('skills.name, COUNT(user_id) as count')
            ->from('skills')
            ->join('user_skills', 'skills.id = user_skills.skills_id')
            ->group_by('skills_id')
            ->order_by('count', 'DESC')
            ->get()
            ->{$this->_return_type(1)}();
            
        return $result;
    }
    
    public function connAndBlockedConnOverTime() {
        $result = $this->_database
            ->select("IF(is_accepted = 1, MONTHNAME(date_accepted), MONTHNAME(date_blocked)) as monthname,
            	IF(is_accepted = 1, MONTH(date_accepted), MONTH(date_blocked)) as month,
            	IF(is_accepted = 1, YEAR(date_accepted), YEAR(date_blocked)) as year,
                COUNT(IF(is_accepted = 1, 1, null)) as count_accepted,
                COUNT(IF(is_blocked = 1, 1, null)) as count_blocked")
            ->from('connections')
            ->group_start()
                ->where('(is_accepted', '1')
                ->where('date_accepted is not null')
            ->group_end()
            ->or_group_start()
                ->where('is_blocked', '1')
                ->where("date_blocked is not null")
            ->group_end()
            ->group_end() // IDK why, but this is required for proper parentheses - Pearse
            ->group_by('year, month')
            ->order_by('year, month')
            ->get()
            ->{$this->_return_type(1)}();
            
        return $result;
    }
}