<?php

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
    }

    private function output_error($message, $error_code=0, $response_data=array()) {
        $response['completed_in'] = $this->benchmark->elapsed_time('api');
        $response['status'] = $error_code;
        $response['message'] = $message;
        if(is_array($response_data) || is_object($response_data)){
            if (count($response_data) >= 1) {
                $response['results'] = $response_data;
            }
        }

        header('Content-Type: application/json');

        log_message("debug", "ERROR: " . print_r($response, true));

        echo json_encode($response);
        exit;
    }

    private function output_success($message, $response_data='') {
        $response['completed_in'] = $this->benchmark->elapsed_time('api');
        $response['status'] = 1;
        $response['message'] = $message;

        if (is_object($response_data)) {
            $response_data = (array) $response_data;
        }

        if(is_array($response_data)){
            if (count($response_data) >= 1) {
                $response['results'] = $response_data;
            }
        }

        header('Content-Type: application/json');

        log_message("debug", "SUCCESS: " . print_r($response, true));

        echo json_encode($response);
        exit;
    }

    public function get_all_products() {

        $this->load->model('manage/products_model');

        $results['products'] = $this->products_model->get_products_api_based();

        if (count($results['products']) <= 0) {
            $this->output_error("No products was found",'501');
           
        }

        $this->output_success("Products retrieved", $results);

    }

    public function get_latest_products() {

        $this->load->model('manage/products_model');

        $results['products'] = $this->products_model->get_latest_api_based();

        if (count($results['products']) <= 0) {
            $this->output_error("No products was found",'501');
           
        }

        $this->output_success("Products retrieved", $results);

    } 

    public function get_product_info() {

        $this->load->model('manage/products_model');

        $where = array();        

        if($_GET) {
            foreach($this->input->get() as $key => $value) {
                $where[$key] = $value;
            }
        }


        $results['products'] = $this->products_model->get_product_info($where);

        if (count($results['products']) <= 0) {
            $this->output_error("No products was found",'501');
           
        }

        $this->output_success("Products retrieved", $results);

    }
}