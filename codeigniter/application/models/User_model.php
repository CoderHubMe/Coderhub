<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    
    public $has_many = array('company_admins', 'user_education_nodes');
    
    public $validate = array(
        array( 'field' => 'username', 
              'label' => 'username',
              'rules' => 'alpha_numeric|max_length[45]' ),
        array( 'field' => 'fname',
              'label' => 'first name',
              'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'lname',
              'label' => 'last name',
              'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'email', 
              'label' => 'email',
              'rules' => 'valid_email' ),
        array( 'field' => 'password', 
              'label' => 'password',
              'rules' => 'min_length[10]' ),
        // array( 'field' => 'birthday',
        //       'label' => 'birthday',
        //       'rules' => 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]')
    );
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_everything($userId = 0) {
        if($userId === 0) {
            return false;
        }
        
        $result = $this->get($userId);
        
        // Get all education
        $this->_database->from('user_education_nodes');
        $this->_database->join('education_nodes', 'user_education_nodes.education_node_id = education_nodes.id');
        $this->_database->where('user_education_nodes.user_id', $userId);
        $this->_database->order_by('education_nodes.start_date', 'DESC');
        $result->education_nodes = $this->_database->get()->{$this->_return_type(1)}();
        
        
        // Get all work history
        $this->_database->from('user_work_nodes');
        $this->_database->join('work_nodes', 'user_work_nodes.work_node_id = work_nodes.id');
        $this->_database->where('user_work_nodes.user_id', $userId);
        $this->_database->order_by('work_nodes.start_date', 'DESC');
        $result->work_nodes = $this->_database->get()->{$this->_return_type(1)}();
        
        // Get all skills
        $this->_database->from('user_skills');
        $this->_database->join('skills', 'user_skills.skills_id = skills.id');
        $this->_database->where('user_skills.user_id', $userId);
        $result->skills = $this->_database->get()->{$this->_return_type(1)}();
        
        // $this->_database->join('user_education_nodes', 'users.id = user_education_nodes.user_id');
        // $this->_database->join('education_nodes', 'user_education_nodes.education_node_id = education_nodes.id');
        // $result = $this->_database->get()->{$this->_return_type(1)}();
        return $result;
    }
}