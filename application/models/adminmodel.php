<?php

    class Adminmodel extends CI_Model{

        function __construct(){
            parent::__construct();
        }
        function insert($data){
            $this->db->insert('admin',$data);
        }
        function search_us($data){
            $this->db->where('username',$data['username']);
            $qr = $this->db->get('admin');
            if ($qr->num_rows() > 0) {
                foreach($qr->result() as $value){
                    $pass_encode = $this->encrypt->decode($value->password);
                    if ($data['password']==$pass_encode) {
                        $userdata = array(
                            'id'=>$value->id,
                            'username'=>$value->username,
                            'authenticated'=>true
                        );
                        $this->session->set_userdata($userdata);
                        redirect('home');
                        return true;
                    }
                    else{
                        $this->session->set_flashdata('error','Login is valid by UserName Or PassWord');
                        redirect('admin/view_login');
                    }
                }
            }
            else{
                $this->session->set_flashdata('error','Login is valid by UserName Or PassWord');
                redirect('admin/view_login');
            }
        }

    }

?>