<?php

require_once 'restricted.php';
require_once(APPPATH . 'exceptions/StopNotFoundException.php');
require_once(APPPATH . 'exceptions/UserHasNoStopsException.php');

// switch back to Restricted when done
class Stops extends Restricted {   
        
        public function index() {
            $data = $this->_loadStopsMenuInfo(); 
            $this->load->view('add_stop', $data);
        }

        public function find($searchInput="") {
                $stops = array();
                $this->load->model('stop_model');
                $this->load->model('location_model');

                if (empty($searchInput)) {
                        $searchInput = $this->input->post('search_input');
                }

                $stops = $this->location_model->findStopsNearLocation($searchInput, 0.5);
                $stops = array_merge($stops, $this->stop_model->find($searchInput));

                $data = $this->_loadStopsMenuInfo(); 
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
                $locations = $this->location_model->getByName($searchInput, false);
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

        private function _loadStopsMenuInfo() {
            $data = array();

            try {
                $this->load->model('userstops_model');
                $data['stops'] = $this->userstops_model->getUserStops($this->session->userdata('user_id')); 
                $data['stop_names'] = $this->userstops_model->getStopNames($data['stops']);
            }
            catch (UserHasNoStopsException $e) {
                $data['stops'] = NULL;
            }
            catch (StopNotFoundException $e) {}

            return $data;
        }
}