<?php
    class admin extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->library('encrypt');
            $this->load->model('adminmodel');
            $this->load->library('form_validation');
            $this->load->library('encrypt');
        }
        function index(){
            $data['view'] = array('admin/insert');
            $this->load->view('masterlayout',$data);
        }
        function insert(){
            $arr = array(
                'required'=>'%s không được để trống',
                'trim'=>'%s không được có khoảng trống',
                'alpha_numeric'=>'%s không được để dấu',
                'min_length'=>'%s ít nhất 6 ký tự'
            );
            $this->form_validation->set_rules('username','Tài khoản','required|trim|alpha_numeric',$arr);
            $this->form_validation->set_rules('password','Mật khẩu','required|trim|min_length[6]|alpha_numeric',$arr);
            $submit = $this->input->post('insert');
            if (isset($submit)) {
                if ($this->form_validation->run() == false) {
                   $this->index();
                }
                else{
                    $data = array(
                        'username'=>$this->input->post('username'),
                        'password'=>$this->encrypt->encode($this->input->post('password')),
                    );
                    $this->adminmodel->insert($data);
                    $this->session->set_flashdata('success','Thêm thành công');
                    redirect('admin/index');
                }
            }
            else{
                redirect('admin/index');
            }
        }
        function view_login(){
            $this->load->view('login');
            if ($this->session->userdata('authenticated')) {
                redirect('home');
            }
        }
        function login(){
            $submit = $this->input->post('login');
            $arr = array(
                'required'=>'%s không được để trống',
                'trim'=>'%s không được có khoảng trống',
                'alpha_numeric'=>'%s không được chứa kí tự đặc biệt',
                'min_length'=>'%s ít nhất 6 ký tự'
            );
            if (isset($submit)) {
                $this->form_validation->set_rules('username','Tài khoản','required|trim|alpha_numeric',$arr);
                $this->form_validation->set_rules('password','Mật khẩu','required|trim|min_length[6]|alpha_numeric',$arr);
                if ($this->form_validation->run() == false) {
                    $this->view_login();
                }
                else{
                    $data = array(
                        'username'=>$this->security->xss_clean($this->input->post('username')),
                        'password'=>$this->security->xss_clean($this->input->post('password')),
                    );
                  $qr = $this->adminmodel->search_us($data);
                }
            }
        }
        function logout(){
            $this->session->sess_destroy();
            redirect('admin/view_login');

        }
        
    }
?>