<?php

require_once 'restricted.php';

class Stops extends Restricted {
        
        public function index() {
                $this->load->view('add_stop');
        }

        public function find($searchInput="") {
                $stops = array();
                $this->load->model('stop_model');

                if (empty($searchInput)) {
                        $searchInput = $this->input->post('search_input');
                }

                $stops = $this->stop_model->find($searchInput);

                $data = array();
                $data['searchResult'] = $stops;

                if (sizeof($stops) == 0) {
                        $data['errorMessage'] = "No bus stops match your criteria";
                }

                $this->load->view('add_stop', $data);
        }

        public function find_autocomplete() {
                $stops = array();
                $this->load->model('stop_model');

                $searchInput = $this->input->post('search_input');
                $stops = $this->stop_model->find($searchInput);

                $response = array();
                foreach ($stops as $stop) {
                        $response[] = $stop->description;
                }

                echo json_encode($response);
        }
}