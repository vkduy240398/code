<?php
    class statusmodel extends CI_Model{

        function __construct(){
            parent::__construct();
        }
        function getStatus(){
            $query = $this->db->get('status');
            return $query;
        }
    }
?>