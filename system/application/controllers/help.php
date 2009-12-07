<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Help extends Controller {
    
    function search() {
        $search = '';
        $page = 1;
        $limit = 10;
        
        if ($this->input->is_ajax_request()) {
            $search = $this->input->post('query', TRUE);
            $page = $this->input->post('page') ? $this->input->post('page') : $page;
        } else {
            $search = str_replace('_', ' ', $this->uri->rsegment(3));
            $limit = 125;
            $page = $this->uri->rsegment(4, $page);
        }
        
        $offset = ($page - 1) * $limit;
        
        $factoids = $this->db->like('name', $search, 'after')->
            order_by('name', 'asc')->get('infobot_factoids')->result();
        $snippets = $this->db->like('name', $search, 'after')->
            order_by('name', 'asc')->get('rum_snippets')->result();
        
        $results = array_merge($factoids, $snippets);
        usort($results, array($this, 'search_autocomplete_sort'));
        $total_results = count($results);
        
        $data = array(
                'query' => $search,
                'results' => array_slice($results, $offset, $limit),
                'total_results' => $total_results,
                'offset' => $offset,
                'page' => $page,
                'total_pages' => max(1, ceil($total_results / $limit)),
                'has_prev_page' => ($page > 1),
                'has_next_page' => (($offset + $limit) < $total_results),
                'ajax_request' => $this->input->is_ajax_request()
            );
	    
	    if ($this->input->is_ajax_request()) {
	        // Output the search results partial.
            $this->load->view('help/_search', $data);
	    } else {
	        // Output the search results page.
	        $this->load->view('help/search', $data);
	    }
    }
    
    function search_autocomplete_sort($a, $b) {
        return strcasecmp($a->name, $b->name);
    }
    
}

?>