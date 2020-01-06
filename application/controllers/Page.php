<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
			$url=base_url();
			redirect($url);
		}
  }

  function index(){
    $this->load->view('v_dashboard');
  }

  function data_mahasiswa(){
    // function ini hanya boleh diakses oleh admin dan dosen
    if($this->session->userdata('akses')=='admin'){
    $data['contents'] = 'admin/content/dashboard';
    $this->load->view('admin/index',$data);
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }

  }

  function input_nilai(){
    // function ini hanya boleh diakses oleh admin dan dosen
    if($this->session->userdata('akses')=='user'){
    $data['contents'] = 'templete_user/content/dashboard';
    $this->load->view('templete_user/index',$data);
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }

}
