<?php
    class ClassStudy extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('studentsmodel');
            $this->load->model('statusmodel');
            $this->load->model('classmodel');
            $this->load->library('form_validation');
            $this->load->library('upload');
            $this->load->library('encrypt');
        }
        function index(){
            $data['list'] = $this->classmodel->getClass();
            $data['view'] = array('class/index');
            $this->load->view('masterlayout',$data);
        }
        function view_insert(){
            $data['view'] = array('class/insert');
            $data['data'] = $this->statusmodel->getStatus();
            $this->load->view('masterlayout',$data);
        }
        function insert(){
            $submit = $this->input->post('insert');
            if (isset($submit)) {
                $arr =array('required'=>'%s không được để trống','is_unique'=>'%s Tên lớp không được trùng nhau');
               $this->form_validation->set_rules('name','Tên lớp','required|is_unique[class.name]',$arr);
               $this->form_validation->set_rules('status','Trạng thái','required',$arr);
               if ($this->form_validation->run() == false) {
                  $this->view_insert();
               }
               else{
                   $data = array(
                    'Name'=>$this->input->post('name'),
                    'id_status'=>$this->input->post('status'),
                   );
                   $this->classmodel->insert($data);
                      $this->session->set_flashdata('success','Insert Successfully');
                      redirect('ClassStudy');    
               }
            }
        }
        function delete(){
            $id = $this->uri->segment(3);
            $qr =  $this->studentsmodel->getst($id);
            if ($qr->num_rows() > 0) {
                $this->session->set_flashdata('Error','Warning: Can have foreign key constraint data,Please check data');
                redirect('ClassStudy/index');
            }
            else{
                $kq = $this->classmodel->delete($id);
                if ($kq==true) {
                   $this->session->set_flashdata('success','Delete SuccessFully');
                   redirect('ClassStudy/index');
                }
            }
        }
        function edit(){
            $id = $this->uri->segment(3);
            $data['list'] = $this->classmodel->edit($id);
            $data['view'] = array('class/edit');
            $data['data'] = $this->statusmodel->getStatus();
            $this->load->view('masterlayout',$data); 
        }
        function update(){
            $submit = $this->input->post('update');
            if (isset($submit)) {
                $arr = array('required'=>'%s không được để trống','is_unique'=>'%s Tên lớp không được trùng nhau');
                $this->form_validation->set_rules('name','Tên lớp','required',$arr);
                $this->form_validation->set_rules('status','Trạng thái','required',$arr);
                if ($this->form_validation->run() == false) {
                   $this->edit();
                }
                else{
                    $data = array(
                    'Name'=>$this->input->post('name'),
                    'id_status'=>$this->input->post('status'),
                    );
                    $this->classmodel->update($data,$this->uri->segment(3));
                    $this->session->set_flashdata('success','Update SuccessFully');
                    redirect('ClassStudy/edit/'.$this->uri->segment(3));
                }
            }
            // $this->session->set_flashdata('Error','Update Valid');
            // redirect('ClassStudy/edit/'.$this->uri->segment(3));
        }
        function ChangeStatus(){
            $data = $this->input->post('InCheck');
        }
    }
?>