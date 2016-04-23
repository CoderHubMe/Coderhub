<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Connections extends MY_Controller {
    private $theme_options = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->helper("url_helper");
        $this->load->model('connection_model', 'connection');
        
        $this->theme_options['menu'] = 'connections';
    }
    
    public function index() {
        // $_SESSION['userId'] = 4;
        if(isset($_SESSION['userId'])){
            redirect(); // redirects user back to the base page
        } else {
            //$this->load->view('login/login.php');
            $this->load->view('login/login.php');
        }
    }
    
    public function request_connection($user_id_requestor, $user_id_connection) {
        if(isset($_SESSION['userId']) || $_SESSION['userId'] == $user_id_requestor) {
            if($existingConnection = $this->connection->requestor_or_connection($user_id_requestor, $user_id_connection)) {
                var_dump($existingConnection);
                if($existingConnection->user_id_requestor == $user_id_connection) {
                    $this->connection->update($existingConnection->id, array('is_accepted' => '1'));
                }
            } else {
                $this->connection->insert(array('user_id_requestor' => $user_id_requestor, 'user_id_connection' => $user_id_connection));
            }
            
            // redirect('users/profile/' . $user_id_requestor);
        }
        
    }
    
}