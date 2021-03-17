<?php
    class classmodel extends CI_model{

        function __construct(){
            parent::__construct();
        }
        function getClass(){
            $query = $this->db->get('class');
            return $query;
        }
        function getclass_status(){
            $this->db->where('id_status',2);
            $query = $this->db->get('class');
            return $query;
        }
        function insert($data){
           $query = $this->db->insert('class',$data);
           if ($query) {
                return true;
           }
           else{
               return false;
           }
        }
        function delete($data){
            $this->db->where('id',$data);
            $query = $this->db->delete('class');
            if ($query) {
                return true;
            }
            else{
                return false;
            }
        }
        function edit($data){
            $this->db->where('id',$data);
           $query =  $this->db->get('class');
           return $query;
        }
        function update($data,$id){
            $this->db->where('id',$id);
            $query = $this->db->update('class',$data);
            if ($query) {
                return true;
            }
            return false;
        }
    }
?>