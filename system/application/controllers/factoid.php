<?php  if (! defined('BASEPATH')) exit('No direct script access');

class Factoid extends Controller {
    
    const factoids_table = 'infobot_factoids';
    const definitions_table = 'infobot_definitions';
    
    function view($id) {
        $query = $this->db->get_where(Factoid::factoids_table, array('id' => $id), 1);
        
        if ($query->num_rows() <= 0) {
            return $this->load->view('factoid/404', array('id' => $id));
        }
        
        $factoid = $query->row();
        $definitions = $this->db->order_by('id', 'asc')->
            get_where(Factoid::definitions_table, array('factoid_id' => $factoid->id))->result();
        
        $data = array(
                'factoid' => $factoid,
                'definitions' => $definitions
            );
        
        $this->load->view('factoid/view', $data);
    }
    
    function edit($id) {
        if ($this->auth->logged_out()) {
            echo '';
            return;
        }
        
        $query = $this->db->get_where(Factoid::factoids_table, array('id' => $id), 1);
        
        if ($query->num_rows() <= 0) {
            return $this->load->view('factoid/_404', array('id' => $id));
        }
        
        $factoid = $query->row();
        $definitions = $this->db->order_by('id', 'asc')->
            get_where(Factoid::definitions_table, array('factoid_id' => $factoid->id))->result();
        
        $data = array(
                'factoid' => $factoid,
                'definitions' => $definitions
            );
        
        $this->load->view('factoid/_edit', $data);
    }
    
    function save() {
        $id = $this->input->post('id');
        $definitions = $this->input->post('definitions');
        
        $this->db->trans_start();
        $this->db->delete(Factoid::definitions_table, array('factoid_id' => $id));
        foreach ($definitions as $definition) {
            if (strlen($definition) <= 0) { continue; }
            
            $data = array(
                    'factoid_id' => $id,
                    'verb' => 'is',
                    'body' => $definition
                );
            $this->db->insert(Factoid::definitions_table, $data);
        }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()) {
            $this->edit($id);
        } else {
            echo "Oops! Something went wrong while attempting to save factoid #{$id}!";
        }
    }
    
    function delete($id) {
        $query = $this->db->get_where(Factoid::factoids_table, array('id' => $id));
        
        if ($query->num_rows() > 0) {
            $factoid = $query->row();
            
            $this->db->trans_start();
            $this->db->delete(Factoid::definitions_table, array('factoid_id' => $id));
            $this->db->delete(Factoid::factoids_table, array('id' => $id));
            $this->db->trans_complete();
        
            if ($this->db->trans_status()) {
                $this->load->view('factoid/_delete', array('factoid' => $factoid));
            } else {
                echo "Oops! Something went wrong while attempting to delete factoid #{$id}!";
            }
        } else {
            echo "Oops! Factoid #{$id} does not exist!";
        }
    }
       
}