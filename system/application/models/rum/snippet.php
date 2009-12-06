<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Snippet extends Model {
    
    const snippets_table = 'rum_snippets';
    
    public $id = null;
    public $created_by = null;
    public $name = null;
    public $body = null;
    public $created_at = null;
    public $updated_at = null;
    
    function __construct() {
        parent::Model();
    }
    
    

}

?>
