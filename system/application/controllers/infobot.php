<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Infobot extends Controller {

	function __construct() {
		parent::Controller();
		
		$this->auth->authorize();
	}
	
	function index() {
		$this->load->view('infobot/index');
	}
	
	function search() {
		$data = array();
		
		if ($this->input->is_ajax_request()) { // then it's an Ajax request
			if ($query = $this->input->post('query')) {
				$this->load->model('infobot/factoid', 'factoid');
				
				$results = $this->factoid->autocomplete_search($query);
				$results_arr = array();
				foreach ($results as $result)
					$results_arr[] = $result->name;
				
				$data['results'] = $results_arr;
			} else {
				$data['results'] = array();
			}
			
			$this->load->view('infobot/search_json', $data);
		} else { // then it's a normal GET request
			if ($factoid = $this->input->post('query')) {
				$this->load->model('infobot/factoid', 'factoid');
				
				if ($query = $this->factoid->get($factoid, FALSE)) { // then we should edit this factoid
					return redirect("factoids/edit/{$query['id']}");
				}
				
				$query = $this->factoid->search($factoid);
				
				if ($query->num_rows() <= 0) { // then we should create a new factoid
					$data['name'] = $this->input->post('query');
					$this->load->view('infobot/create', $data);
				} else { // then we've got a bunch of results to show
					$data['query'] = $this->input->post('query');
					$data['results'] = $query->result();
					$this->load->view('infobot/search', $data);
				}
			} else {
				redirect('factoids');
			}
		}
	}
	
	function create() {
		// TODO: Factoid creation!
	}
	
	function edit($id) {
		$this->load->model('infobot/factoid', 'factoid');
		
		$data = array();
		$data['factoid'] = $this->factoid->get($id);
		
		$this->load->view('infobot/edit', $data);
	}
	
	function update() {
		if (!$this->input->is_ajax_request())
			redirect('factoids');
		
		$id = $this->input->post('id');
		$definitions = $this->input->post('definitions');
		
		$this->load->model('infobot/factoid', 'factoid');
		
		if ($this->factoid->update_definitions($id, $definitions)) {
			echo '{"result": "success"}';
		} else {
			echo '{"result": "error"}';
		}
	}

}
