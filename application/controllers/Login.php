<?php
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}

	function index(){
		$data['contents'] = 'templete_user/content/login';
		$this->load->view('templete_user/index',$data);
	}

	function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

        $cek_pelabuhan=$this->login_model->auth_($username,$password);

        if($cek_pelabuhan->num_rows() > 0){ //jika login sebagai dosen
						$data=$cek_pelabuhan->row_array();
        		$this->session->set_userdata('masuk',TRUE);

		         if($data['level']=='ADMIN'){ //Akses pelabuhan
		            $this->session->set_userdata('akses','ADMIN');
					$this->session->set_userdata('ses_id',$data['no']);
		            $this->session->set_userdata('ses_nama',$data['nama']);/*
		            $this->session->set_userdata('ses_poto',$data['photo']);*/
		            redirect('admin_controller');

		         }else if($data['level']=='USER'){ //akses timbangan
		            $this->session->set_userdata('akses','USER');
					$this->session->set_userdata('ses_id',$data['no']);
		            $this->session->set_userdata('ses_nama',$data['nama']);
		            $this->session->set_userdata('ses_poto',$data['photo']);
		            $this->session->set_userdata('ses_alamat',$data['alamat']);
		            $this->session->set_userdata('ses_nohp',$data['nohp']);
		            redirect('welcome_user');

		         }


        }else{ 
							$url=base_url();
							echo $this->session->set_flashdata('msg','Username Atau Password Salah !!!');
							redirect($url);
					
        }

    }

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('index.php/Login');
        redirect($url);
    }
    public function daftar()
	{
		$data['contents'] = 'templete_user/content/daftar';
		$this->load->view('templete_user/index',$data);
	}
	

	function upload(){

	$filename = md5(uniqid(rand(), true));
	$config = array(
		'upload_path' => 'upload',
		'allowed_types' => "gif|jpg|png|jpeg",
		'file_name' => $filename
	);
	
	
	$this->load->library('upload', $config);
	if($this->upload->do_upload())
		{
		$file_data = $this->upload->data();

		$data['user'] = $_POST['user'];
		$data['password'] = $_POST['password'];
		$data['nama'] = $_POST['nama'];
		$data['alamat'] = $_POST['alamat'];
		$data['nohp'] = $_POST['nohp'];
		$data['level'] = "USER";

		$data['photo'] = $file_data['file_name'];


		$this->load->model('upload_images');
		$this->upload_images->save_image2($data);
		
		$data['message'] = "Anda Berhasil Daftar Silahkan Login !!";
	
		$data['contents'] = 'templete_user/content/daftar';
		$this->load->view('templete_user/index',$data);
		}
		else
		{
		$data = array();	
		$this->load->model('upload_images');			
		$data['uploaded_images'] = $this->upload_images->get_images();
		
		$error = $this->upload->display_errors();
		$data['errors'] = $error;

		$data['contents'] = 'templete_user/content/daftar';
		$this->load->view('templete_user/index',$data);
		}
}




}
