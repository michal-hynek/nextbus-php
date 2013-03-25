<?php

require_once 'restricted.php';

class Stops extends Restricted {

        public function index() {
                $this->load->view('add_stop');
        }

        public function find($searchInput="") {
                $stops = array();
                $this->load->model('stop_model');
                $this->load->model('location_model');

                if (empty($searchInput)) {
                        $searchInput = $this->input->post('search_input');
                }

                $stops = $this->location_model->findStopsNearLocation($searchInput, 0.2);
                $stops = array_merge($stops, $this->stop_model->find($searchInput));

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
                $this->load->model('location_model');

                $searchInput = $this->input->post('search_input');
                $locations = $this->location_model->getByName($searchInput);
                $stops = $this->stop_model->find($searchInput);

                $response = array();
                foreach ($locations as $location) {
                       $response[]  = $location->name;
                }
                foreach ($stops as $stop) {
                        $response[] = $stop->description;
                }

                echo json_encode($response);
        }
}