<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public $module_name = 'products';
    public $model_name = 'products_model';
    public $page_title = 'Products';

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

		$limit = 20;
        $model = $this->model_name;

        $this->load->model('manage/'.$model);

        $view_data['model'] = $model;
        $view_data['records'] = $this->$model->search_product();
        
		$this->load->view('manage/products/index', $view_data);
	}

	public function add()
    {
        $this->page_title = 'Add ' . $this->page_title;

        $model = $this->model_name;

        $this->load->model('manage/'.$model);

        if (!count($_POST))
        {
            $record = $this->$model->get_structure();

            if ($record)
            {
                $view_data['record'] = $record;
                
                $this->load->view('manage/' . $this->module_name . '/add', $view_data);

            }
        }
    }

    public function upload() 
    {

    	$this->load->library('upload');
        $this->load->model('manage/products_model');

        $ext = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|png|jpg'; 

        $this->load->library('upload');

        $this->upload->initialize($config);

        if($this->upload->do_upload('media')) {

            if(($ext == "png") || ($ext == "gif") || ($ext == "jpg")){
                $type = 2;
            }

            $file = $this->upload->data();
            
            $new_data = array(
                'thename' => $this->input->post('thename'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'image' => $file['orig_name'],
            );
                
            $rec = $this->products_model->add($new_data);
            if($rec){
                $this->session->set_flashdata('system_success', 'Products Added');
                
                redirect('/manage/' . $this->module_name . '/');
            }
                
        } else {

        	$this->session->set_flashdata('system_error', $this->upload->display_errors('',''));
            
            redirect('/manage/' . $this->module_name . '/add');  
        }

    }

    public function edit($id=0)
    {
        $this->page_title = 'Edit ' . $this->page_title;

        $this->load->model('manage/products_model');

        //get the metadata
        $meta = $this->products_model->get_structure();
        foreach ($meta as $md) {
            $meta_data[$md->name] = $md->type;
        }

        if (!count($_POST)) {
            $record = $this->products_model->get($id);
            if ($record) {
                $view_data['record'] = $record[0];
                
                $this->load->view('manage/' . $this->module_name . '/edit', $view_data);
            }
        }
    }

    public function edit_data($id = 0) 
    {

    	$this->load->library('upload');
        $this->load->model('manage/products_model');

        $file = array();

        $file_image = $this->products_model->get_file($id);
        
        if(!empty($_FILES) && $_FILES['media']['error'] == 0) {
        	
        	$ext = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);

	        $config['upload_path'] = './uploads/';
	        $config['allowed_types'] = 'gif|png|jpg'; 

	        $this->load->library('upload');

	        $this->upload->initialize($config);

	        if($this->upload->do_upload('media')) {

		        if(($ext == "png") || ($ext == "gif") || ($ext == "jpg")){
	                $type = 2;
	            }

	            $file = $this->upload->data();
	        } else {

	        	$this->session->set_flashdata('system_error', $this->upload->display_errors('',''));

	        	redirect('/manage/' . $this->module_name . '/edit/'.$id);
	        }

        }
        
        $new_data = array(
            'thename' => $this->input->post('thename'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'), 
        );    
        
        if(!empty($file)){
        	$new_data['image'] = $file['orig_name'];
        }

        $where = array('id' => $id);
        $rec = $this->products_model->update($where,$new_data);
        
        if($rec) {

        	if(!empty($file)){
	        	
        
		        $path = './uploads/'.$file_screen;

		        unlink($path);
	        }

	        $this->session->set_flashdata('system_success', 'Product information updated!');

        	redirect('/manage/' . $this->module_name . '/');
        } else {

        	$this->session->set_flashdata('system_error', "Unable to update the information of the product you're trying to update.");
        	redirect('/manage/' . $this->module_name . '/edit/'.$id);
        }        

    }

    public function delete($id = "")
    {

        $this->load->model('manage/products_model');

        $file_screen = $this->products_model->get_file($id);
        
        $path = './uploads/'.$file_image;

        unlink($path);

        $remove_status = $this->products_model->delete_product($id);

        if($remove_status){

            $this->session->set_flashdata('system_success', 'Product removed.');
        }else{
            $this->session->set_flashdata('system_error', 'An error occured during product removal.');
        }

        redirect(base_url()."manage/".$this->module_name."/");
    }


}
