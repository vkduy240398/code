<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('studentsmodel');
		$this->load->model('classmodel');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->database();
		$this->login_check();
		
	}
	 function index()
	{	
		$this->load->view('masterlayout');
	}
	private function login_check(){
		if (!$this->session->userdata('authenticated')) {
			redirect('admin/view_login');
		}
	}
	 function list_HV(){
		 $data['list'] = $this->studentsmodel->getlist();
		 $data['data'] = $this->classmodel->getClass();
		 $data['view'] = array('students/index');
		 $this->load->view('masterlayout',$data);
	}
	function view_insert(){
		$data['view'] = array('students/insert');
		$data['data'] = $this->classmodel->getclass_status();
		$this->load->view('masterlayout',$data);
	}
	function insert(){
		$submit = $this->input->post('insert');
		if (isset($submit)) {
			$arr = 	array('required'=>'%s không được để trống',
			"max_length"=>'%s nhiều nhất 10 ký tự',
			"min_length"=>'%s ít nhất 10 ký tự',
			'numeric'=>'%s phải là chữ số',
			'trim'=>'%s không được có khoảng trắng',
			"valid_email"=>'%s Email không đúng định dạng',
		);
			$this->form_validation->set_rules('name','Họ Tên','required',$arr);
			$this->form_validation->set_rules('gender','giới tính','required',$arr);
			$this->form_validation->set_rules('address','Địa chỉ','required',$arr);
			$this->form_validation->set_rules('Email','Địa chỉ Email','trim|required|valid_email',$arr);
			$this->form_validation->set_rules('phone','Số điện thoại','required|max_length[10]|min_length[10]|numeric|trim',$arr);
			$this->form_validation->set_rules('class','Lớp','required',$arr);
			if ($this->form_validation->run()==false) {
				$this->view_insert();
			}
			else{
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				
				if (false === array_search($finfo->file($_FILES['avatar']['tmp_name']), array('jpg' => 'image/jpg','jpeg' => 'image/jpeg', 'png' => 'image/png'),true)) {
					$this->session->set_flashdata('errorImage','Ảnh không đúng định dạng');
					redirect('home/view_insert');
				}
				else{
					if ($_FILES['avatar']['size'] > 5*1024*1024) { //10 MB (size is also in bytes)
						$alert = "Dung lượng hình không được quá 2MB";
					}
					else{
						$data = array (
							'Name'=>$this->encrypt->encode($this->input->post('name')),
							'gender'=>$this->encrypt->encode($this->input->post('gender')),
							'avatar'=>$this->encrypt->encode($_FILES['avatar']['name']),
							'Address'=>$this->encrypt->encode($this->input->post('address')),
							'Email'=>$this->input->post('Email'),
							'Phone'=>$this->encrypt->encode($this->input->post('phone')),
							'id_class'=>$this->input->post('class'),
						);
							$this->studentsmodel->insertdata($data);
							$qr = $this->studentsmodel->selectId();
							foreach($qr->result() as $values){
								$id_student =  $values->id;
							}
							$candidate_id =$id_student;
								if (!is_dir ('./public/uploads/'.$candidate_id )) {
									mkdir('./public/uploads/'.$candidate_id, 0777, true );
							}
							$config['upload_path'] ='./public/uploads/'.$candidate_id.'/';
							$config['allowed_types'] ='gif|png|jpg|jpeg';
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('avatar')) {
								$image = $this->upload->data();
								$fileName =$image['file_name'];
								$data = array (
									'avatar'=>$this->encrypt->encode($fileName),	
								);
								$this->studentsmodel->update_data($data,$id_student);
								$this->session->set_flashdata('action','Thêm thành công học viên');
								redirect('Home/view_insert');
							}
							else{
								$this->session->set_flashdata('errorImage','Ảnh đại diện chưa có vui lòng update lại trong danh sách học viên');
								redirect('Home/view_insert');
							}
							$this->session->set_flashdata('action','Thêm thành công học viên');
							redirect('Home/view_insert');
					}
				}	

			}
		}
	}
	function delete(){
			$nameImage = $this->studentsmodel->edit($this->uri->segment(3));
			foreach($nameImage->result() as $values){
				$name = $this->encrypt->decode($values->avatar);
			}
			$nameImageInFolder = 'public/uploads/'.$this->uri->segment(3).'/'.$name.'';
			$kq = $this->studentsmodel->delete($this->uri->segment(3));
			$folder = 'public/uploads/'.$this->uri->segment(3).'';
			rmdir($folder);
			if ($kq == true) {
				if (file_exists($nameImageInFolder)) {
					unlink($nameImageInFolder);
					rmdir($folder);
				}
				$this->session->set_flashdata('action','Xóa thành công');
				redirect('Home/list_HV');
			}
			else{
				$this->session->set_flashdata('error','Xóa thất bại');
				redirect('Home/list_HV');
			}
		}
		function edit(){
			$data['data'] = $this->classmodel->getClass();
			$data['edit'] = $this->studentsmodel->edit($this->uri->segment(3));
			$data['view'] = array('students/edit');
			$this->load->view('masterlayout',$data);
	}
	function update(){
		$submit = $this->input->post('update');
		if (isset($submit)) {
		$this->form_validation->set_rules('name','Họ Tên','required',
			array('required'=>'%s không được để trống')
		);
		$this->form_validation->set_rules('gender','giới tính','required',array('required'=>'%s không được để trống'));
			$this->form_validation->set_rules('address','Địa chỉ','required',array('required'=>'%s không được để trống'));
			$this->form_validation->set_rules('Email','Địa chỉ Email','trim|required|valid_email',
				array('required'=>'%s không được để trống',
				"valid_email"=>'%s Email không đúng định dạng')
				);
			$this->form_validation->set_rules('phone','Số điện thoại','required|max_length[10]|min_length[10]',
			array('required'=>'%s không được để trống',
			"max_length"=>'%s nhiều nhất 10 ký tự',
			"min_length"=>'%s ít nhất 10 ký tự'));
			$this->form_validation->set_rules('class','Lớp','required',
				array('required'=>'%s không được để trống'));
			if ($this->form_validation->run()==false) {
				redirect('Home/edit/'.$this->uri->segment(3).'');
			}
			else{
				$id = $this->uri->segment(3);
	
					$data = array (
						'Name'=>$this->encrypt->encode($this->input->post('name')),
						'gender'=>$this->encrypt->encode($this->input->post('gender')),
						// 'avatar'=>$this->encrypt->encode($_FILES['avatar']['name']),
						'Address'=>$this->encrypt->encode($this->input->post('address')),
						'Email'=>$this->input->post('Email'),
						'Phone'=>$this->encrypt->encode($this->input->post('phone')),
						'id_class'=>$this->input->post('class'),
					);
					$this->studentsmodel->update_data($data,$id);
					$this->session->set_flashdata('action','Sửa thành công');
					redirect('Home/edit/'.$this->uri->segment(3).'');
		
			}
		}
	}
	function updateImage(){
		$data['edit'] = $this->studentsmodel->edit($this->uri->segment(3));
		$data['view'] = array('students/editImage');
		$this->load->view('masterlayout',$data);
	}
	function updateAvatar(){
		$id = $this->uri->segment(3);
		$candidate_id =$id;
		$config['upload_path'] ='./public/uploads/'.$candidate_id.'';
		$config['allowed_types'] ='gif|png|jpg|jpeg';
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$filereplce = str_replace(" ","_",$_FILES['avatar']['name']);
		
		$fileanme = 'public/uploads/'.$candidate_id.'/'.$filereplce.'';
		if (file_exists($fileanme)) {
			unlink($fileanme);
		}
		if ($this->upload->do_upload('avatar')) {
			$image = $this->upload->data();
			$fileName = $image['file_name'];
			$data = array (
				'avatar'=>$this->encrypt->encode($fileName),	
			);
			$this->studentsmodel->update_data($data,$id);
			$this->session->set_flashdata('action','Sửa thành công');
			redirect('Home/updateImage/'.$this->uri->segment(3).'');
		}
		else{
			$this->session->set_flashdata('error','Ảnh đại diện upload thất bại');
			redirect('Home/updateImage/'.$this->uri->segment(3).'');
		}
	}
	function searchClass(){
		$id_class = $this->input->post('id_class');
		$search_email = $this->input->post('search_email');	
		$data['data'] = $this->studentsmodel->searchClass($id_class,$search_email);
		$data['class_id'] = $this->classmodel->getClass();
		$this->load->view('ajax/search',$data);
	}
	function Pagination(){
		$page = $this->input->post('page');
		if (isset($page)) {
			$page = $this->input->post('page');
		}
		else{
			$page =1;
		}
		$data['data'] = $this->studentsmodel->Pagination($page);
		$data['class_id'] = $this->classmodel->getClass();
		$this->load->view('ajax/pagination',$data);
	}
	function update_id_class(){
		$id = $this->input->post('id');
		$_this = $this->input->post('_this');
		$qr = $this->studentsmodel->update_id_class($_this,$id);
	}

	function checkImage(){
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$aler = '';
		if (false === array_search($finfo->file($_FILES['image']['tmp_name']), array('jpg' => 'image/jpg','jpeg' => 'image/jpeg', 'png' => 'image/png'),true)) {
			echo $aler ="Ảnh không đúng định dạng";
		}	
		if ($_FILES['image']['size'] > 5*1024*1024) { //10 MB (size is also in bytes)
				echo $alert = "Dung lượng hình không được quá 5MB";
			}	
	}
}
