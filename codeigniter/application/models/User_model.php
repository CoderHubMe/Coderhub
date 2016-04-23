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
        array( 'field' => 'github_username',
                'label' => 'github username',
                'rules' => 'alpha|max_length[45]' ),
        array( 'field' => 'auth_token',
                'label' => 'token',
                'rules' => 'alpha_numeric|max_length[45]' ),
        array( 'field' => 'profile_image_url',
                'label' => 'profile image',
                'rules' => 'max_length[100]' ),
        array( 'field' => 'description',
                'label' => 'description',
                'rules' => 'max_length[65535]' ),        
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
        
        // Get all accepted connections
        $this->_database->select('users.fname, users.lname, users.username, users.id, users.profile_image_url')
            ->from('connections')
            ->join('users', 'connections.user_id_requestor=users.id OR connections.user_id_connection=users.id')
            ->group_start()
                ->where('user_id_requestor', $userId)
                ->or_where('user_id_connection', $userId)
            ->group_end()
            ->where('connections.is_accepted !=', 0)
            ->where('connections.is_blocked', 0)
            ->where('users.id !=', $userId);
        $result->accepted_connections = $this->_database->get()->{$this->_return_type(1)}();
        
        
        // Get all requested connections
        $this->_database->select('users.fname, users.lname, users.username, users.id, users.profile_image_url')
            ->from('connections')
            ->join('users', 'connections.user_id_requestor=users.id')
            ->where('user_id_connection', $userId)
            ->where('is_accepted', 0)
            ->where('is_blocked', 0);
        $result->requested_connections = $this->_database->get()->{$this->_return_type(1)}();
        
        return $result;
    }
    
    public function search($searchKey, $fieldsToSearch) {
        if(is_array($fieldsToSearch)) {
            $orFlag = false;
            foreach($fieldsToSearch as $field) {
                if($orFlag == false){
                    $this->_database->like($field, $searchKey);
                    $orFlag = true;
                } else {
                    $this->_database->or_like($field, $searchKey);
                }
            } 
        } else {
            $this->_database->where($field, $searchKey);
        }
        
        return $this;
    }
}