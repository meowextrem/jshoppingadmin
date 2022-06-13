<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $page_title = 'Admin Dashboard';

	public $module_name = 'home';

    public $kiosk;

    public function __construct() {
        parent::__construct();

        $this->load->library('Admin_Menu');
        $this->load->library('session');

        $this->menu = array(
        					'home' => array('title' => 'Home', 'path' => ''),
        					'products' => array('title' => 'Products', 'path' => 'products'), 
        				);
    }

	public function index()
	{

		$view_data['menu'] = $this->menu;
		$view_data['page_title'] = 'home';

		$this->load->view('manage/home/homeview', $view_data);
	}
}
