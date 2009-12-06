<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Command extends Controller {
    
    function search() {
        $search = $this->input->post('query');
        
        $factoids = $this->db->like('name', $search, 'after')->
            order_by('name', 'asc')->get('infobot_factoids')->result();
        $snippets = $this->db->like('name', $search, 'after')->
            order_by('name', 'asc')->get('rum_snippets')->result();
        
        $results = array_merge($factoids, $snippets);
        usort($results, array($this, 'search_autocomplete_sort'));
        
        $data = array(
		        'results' => array_slice($results, 0, 10),
		        'total_results' => count($results)
		    );
		
        $this->load->view('command/_search', $data);
    }
    
    function search_autocomplete_sort($a, $b) {
        return strcasecmp($a->name, $b->name);
    }
    
}

?>