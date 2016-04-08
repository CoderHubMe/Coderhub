<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->set_message("This is a message");
        $theme = array(
            'menu' => 'user',
            'title' => "Home Page",
            'subtitle' => 'No Place Like Home',
            'breadcrumbs' => array('Home' => base_url())
        );
        
        $this->set_var('theme', $theme);
        $this->render();
    }
}