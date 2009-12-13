<?php  if (! defined('BASEPATH')) exit('No direct script access');

class Snippet extends Controller {
	
	const snippets_table = 'rum_snippets';
	
	function view($id) {
	    $query = $this->db->get_where(Snippet::snippets_table, array('id' => $id));
	    
	    if ($query->num_rows() > 0) {
	        $snippet = $query->row();
	        $created_by = $this->db->get_where('session_accounts', array('id' => $snippet->created_by))->row();
	        $updated_by = $this->db->get_where('session_accounts', array('id' => $snippet->updated_by))->row();
	        
	        $data = array(
	                'snippet' => $snippet,
	                'created_by' => $created_by,
	                'updated_by' => $updated_by
	            );
	        
	        $this->load->view('snippet/view', $data);
	    } else {
	        $data = array(
	                'header' => 'Snippet not found',
	                'message' => "Oops! Snippet #{$id} does not exist!"
	            );
	        
	        $this->load->view('application/error', $data);
	    }
	}
	
	function create() {
	    $this->auth->authorize('helper');
	    
	    $this->load->library('form_validation');
	    
	    if ($this->form_validation->run() == FALSE) {
	        $this->load->view('snippet/create');
	    } else {
	        $now = date('Y-m-d H:i:s');
	        $account_id = $this->auth->account()->id;
	        $data = array(
	                'created_by' => $account_id,
	                'updated_by' => $account_id,
	                'name' => $this->input->post('name'),
	                'arguments' => $this->input->post('arguments'),
	                'parser' => $this->input->post('parser'),
	                'body' => $this->input->post('body'),
	                'created_at' => $now,
	                'updated_at' => $now
	            );
	        
	        $this->db->insert(Snippet::snippets_table, $data);
	        
	        $this->session->set_flashdata('success', "Snippet created!");
	        $id = $this->db->insert_id();
	        redirect("snippet/{$id}");
	    }
	}
	
	function edit($id) {
	    $this->auth->authorize('helper');
	    
	    $query = $this->db->get_where(Snippet::snippets_table, array('id' => $id));
	    
	    if ($query->num_rows() > 0) {
	        $snippet = $query->row();
	        $created_by = $this->db->get_where('session_accounts', array('id' => $snippet->created_by))->row();
	        $updated_by = $this->db->get_where('session_accounts', array('id' => $snippet->updated_by))->row();
	        
	        $data = array(
	                'snippet' => $snippet,
	                'created_by' => $created_by,
	                'updated_by' => $updated_by
	            );
	        
	        $this->load->view('snippet/_edit', $data);
	    } else {
	        $data = array(
	                'header' => 'Snippet not found',
	                'message' => "Oops! Snippet #{$id} does not exist!"
	            );
	        
	        $this->load->view('application/_error', $data);
	    }
	}
	
	function save() {
	    $this->auth->authorize('helper');
	    
	    $this->load->library('form_validation');
	    
	    $id = $this->input->post('id');
	    $query = $this->db->get_where(Snippet::snippets_table, array('id' => $id));
	    
	    if ($query->num_rows() > 0) {
	        if ($this->form_validation->run() == FALSE) {
	            $snippet = $query->row();
	            
	            $data = array(
	                    'snippet' => $snippet,
	                    'created_by' => $this->db->get_where('session_accounts', array('id' => $snippet->created_by))->row(),
	                    'updated_by' => $this->db->get_where('session_accounts', array('id' => $snippet->updated_by))->row()
	                );
	            
    	        $this->load->view('snippet/_edit', $data);
    	    } else {
    	        $now = date('Y-m-d H:i:s');
    	        $data = array(
    	                'updated_by' => $this->auth->account()->id,
    	                'name' => $this->input->post('name'),
    	                'arguments' => $this->input->post('arguments'),
    	                'parser' => $this->input->post('parser'),
    	                'body' => $this->input->post('body'),
    	                'updated_at' => $now
    	            );

    	        $this->db->where('id', $id)->update(Snippet::snippets_table, $data);

    	        $this->edit($id);
    	    }
	    } else {
	        $data = array(
	                'header' => 'Snippet not found',
	                'message' => "Oops! Snippet #{$id} does not exist!"
	            );
	        
	        $this->load->view('application/_error', $data);
	    }
	}
	
	function delete($id) {
        $this->auth->authorize('helper');

        $query = $this->db->get_where(Snippet::snippets_table, array('id' => $id));
        
        if ($query->num_rows() > 0) {
            $snippet = $query->row();
            
            $this->db->delete(Snippet::snippets_table, array('id' => $id));
            
    	    $this->load->view('snippet/_delete', array('snippet' => $snippet));
        } else {
            $data = array(
                    'header' => 'Snippet not found',
                    'message' => "Oops! Snippet #{$id} does not exist!"
                );
            
            $this->load->view('application/_error', $data);
        }
	}
	
	function snippet_create_name_check($name) {
	    $query = $this->db->get_where(Snippet::snippets_table, array('name' => $name));
	    
	    if ($query->num_rows() > 0) {
	        $this->form_validation->set_message('snippet_create_name_check', "The snippet name \"{$name}\" is already in use.");
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
	function snippet_update_name_check($name) {
	    $id = $this->input->post('id');
	    $query = $this->db->get_where(Snippet::snippets_table, array('id' => $id));
	    
	    if ($query->num_rows() > 0) {
	        $snippet = $query->row();
	        
	        if (strcasecmp($name, $snippet->name) == 0) {
	            return TRUE;
	        }
	    }
	    
	    $query = $this->db->get_where(Snippet::snippets_table, array('name' => $name));
	    
	    if ($query->num_rows() > 0) {
	        $this->form_validation->set_message('snippet_update_name_check', "The snippet name \"{$name}\" is already in use.");
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
}