<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rum extends Controller {

	function __construct() {
		parent::Controller();
	}
	
	function new_snippet() {
		if ($name = $this->input->post('name')) {
		    $this->load->library('form_validation');
		    
			$this->form_validation->set_error_delimiters('<div class="flash error">', '</div>');
			
		    $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]|alpha_dash|callback_snippet_name_check');
		    $this->form_validation->set_rules('arguments', 'Arguments', 'max_length[255]');
		    $this->form_validation->set_rules('body', 'Code', 'required');
		    
		    if ($this->form_validation->run() == TRUE) {
		        $now = date('Y-m-d H:i:s');
		        $snippet = array(
	                'created_by' => $this->auth->account()->id,
	                'name' => $name,
	                'arguments' => $this->input->post('arguments'),
	                'body' => $this->input->post('body'),
	                'created_at' => $now,
	                'updated_at' => $now );
		        $this->db->insert('rum_snippets', $snippet);
		        $snippet_id = $this->db->insert_id();
		        echo "New snippet id {$snippet_id} created!";
		    } else {
		        $this->load->view('rum/snippets_new');
		    }
		} else {
		    $this->load->view('rum/snippets_new');
		}
	}
	
	function snippet_name_check($name) {
	    $query = $this->db->get_where('rum_snippets', array('name' => $name));
	    if ($query->num_rows() > 0) {
	        $this->form_validation->set_message('snippet_name_check', "That snippet name is already taken");
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
}

?>