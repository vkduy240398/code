<?php

    class studentsmodel extends CI_model{

        function getlist(){
            $arr = ("SELECT students.id as 'id',students.Name as 'Name',students.gender as 'gender',students.avatar as 'avatar',students.Address as 'Address',students.Email as 'Email',students.Phone as 'Phone',class.name as 'id_class',class.id as 'id_cl' FROM `students`,class WHERE students.id_class = class.id");
           $query = $this->db->query($arr);
           return $query;
        }
        function insertdata($data){
            $this->db->insert('students',$data);
        }
        function delete($data){
            $this->db->where('id',$data);
            $query = $this->db->delete('students');
            if ($query) {
               return true;
            }
            return false;
        }
        function edit($data){
            $arr = ("SELECT students.id as 'id',students.Name as 'Name',students.gender as 'gender',students.avatar as 'avatar',students.Address as 'Address',students.Email as 'Email',students.Phone as 'Phone',class.name as 'Name_class',class.id as 'id_class' FROM `students`,class WHERE students.id_class = class.id and students.id = $data");
            $query = $this->db->query($arr);
            return $query;
        }
        function update_data($data,$id){
            $this->db->where('id',$id);
            $this->db->update('students',$data);
        }
        function searchClass($data,$search_email){
            $arr =("SELECT students.id as 'id',students.Name as 'Name',students.gender as 'gender',students.avatar as'avatar',students.Address as 'Address',students.Email as 'Email',students.Phone as 'Phone',class.name as 'Name_class',class.id as 'id_class' FROM `students`,class 
            WHERE students.id_class = class.id and id_class LIKE '%$data%' And students.Email like '%$search_email%'");
            $query = $this->db->query($arr);
            return $query;
        }
        function selectId(){
            $arr = ("SELECT MAX(id) as 'id' from students");
            $query = $this->db->query($arr);
            return $query;
        }
        function Pagination($page){
            $num_stu_one_page = 4;
            $postion_get = ($page - 1)*$num_stu_one_page;
            $arr =("SELECT students.id as 'id',students.Name as 'Name',students.gender as 'gender',students.avatar as'avatar',students.Address as 'Address',students.Email as 'Email',students.Phone as 'Phone',class.name as 'Name_class',class.id as 'id_class' FROM `students`,class 
            WHERE students.id_class = class.id Limit $postion_get,$num_stu_one_page ");
            $query = $this->db->query($arr);
            return $query;
        }
        function update_id_class($_this,$id){
          $arr =("UPDATE students SET `id_class`=$_this WHERE id =$id");
          $query = $this->db->query($arr);
            return $query;
        }
        function getst($data){
            $this->db->Where('id_class',$data);
            $query = $this->db->get('students');
            return $query;
        }
    }

?>