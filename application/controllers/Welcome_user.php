<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_user extends CI_Controller {
	public function __construct()
	{
		parent::__construct();




		$this->load->model('user');
	}

	public function index()
	{
		

		$data['contents'] = 'templete_user/content/dashboard';
		$this->load->view('templete_user/index',$data);

		
		// $data2['contents2'] = 'templete_user/content/header_desc';
		// $this->load->view('templete_user/index',$data2);
		

	}


/*	public function pesan()
	{
		$data['contents'] = 'templete_user/content/pesan';
		$this->load->view('templete_user/index',$data);


	}*/


	function pesan(){	

			date_default_timezone_set("Asia/Jakarta");
			$data['id_order'] = $_POST['produk'].'tbl_order';
			$data['tanggal'] = date("Y-m-d");
			$data['nama'] = $this->session->userdata('ses_nama');
			$data['no_hp'] = $this->session->userdata('ses_nohp');
			$data['alamat'] = $this->session->userdata('ses_alamat');
			$data['produk'] = $_POST['produk'];
			$data['kun'] = "1";
			$this->load->model('user');
			$this->user->save_order($data);
				$data['message'] = "uploaded";
			$data['contents'] = 'templete_user/content/beritainfohasildesatemp';
			$this->load->view('templete_user/index',$data);
			$x['data']=$this->user->get_all_berita1();
			$this->load->view('templete_user/content/beritainfohasildesa',$x,$data);
	}



















	public function saran()
	{			
		if($this->session->userdata('akses') != "USER"){
			$url=base_url();
			redirect($url);
		}
		$data['contents'] = 'templete_user/content/saran';
		$this->load->view('templete_user/index',$data);
	}
	function upload_saran(){		
			date_default_timezone_set("Asia/Jakarta");
			$data['tanggal'] = date("Y-m-d");
			$data['nama'] = $this->session->userdata('ses_nama');
			$data['isisaran'] = $_POST['saran'];

			$this->load->model('user');
			$this->user->save_saran($data);
				$data['message'] = "Saran Berhasil dikirim !!!";
			$data['contents'] = 'templete_user/content/saran';
			$this->load->view('templete_user/index',$data);
	}






































	
	public function profile()
	{
		$data['contents'] = 'templete_user/content/profile';
		$this->load->view('templete_user/index',$data);
	}

	public function detailberitainfo()
	{
		$data['contents'] = 'templete_user/content/detail/detailberitainfo';
		$this->load->view('templete_user/index',$data);
	}

	public function detailberitainfohasildesa()
	{
		$data['contents'] = 'templete_user/content/detail/detailberitainfohasildesa';
		$this->load->view('templete_user/index',$data);
	}
	public function agenda()
	{
		$data['contents'] = 'templete_user/content/agenda';
		$this->load->view('templete_user/index',$data);
	}























	public function beritainfohasildesa()
	{
		$data['contents'] = 'templete_user/content/beritainfohasildesatemp';
		$this->load->view('templete_user/index',$data);
		$x['data']=$this->user->get_all_berita1();
		$this->load->view('templete_user/content/beritainfohasildesa',$x,$data);
	}

		function view1(){
		$data['contents'] = 'templete_user/content/beritainfohasildesatemp';
		$this->load->view('templete_user/index',$data);
		$kode=$this->uri->segment(3);
		$kode1=$this->uri->segment(3);
		$data['a']=$this->uri->segment(3);
		$data['data1']=$this->user->get_berita_by_kode1($kode);
		$data['data2']=$this->user->get_komentar_tbl_hd($kode1);
		$this->load->view('templete_user/content/beritainfohasildesadet',$data);
	}	
	function upload_a(){		
			date_default_timezone_set("Asia/Jakarta");
			$data['tanggal'] = date("Y-m-d");
			$data['kd_komentar'] = $_POST['kd_komentar'].'tbl_hd';
			$data['nama'] = $_POST['nama'];
			$data['isikomentar'] = $_POST['isi'];
			$this->load->model('user');
			$this->user->save_komentar($data);
				$data['message'] = "uploaded";
			$a = $_POST['a'];
			echo $a;
			$url=base_url().'index.php/welcome_user/view1/'.$a;
			redirect($url);
	}








	public function beritainfo()
	{
		$data['contents'] = 'templete_user/content/beritainfotemp';
		$this->load->view('templete_user/index',$data);
		$x['data']=$this->user->get_all_berita();
		$this->load->view('templete_user/content/beritainfo',$x,$data);
	}
		function view(){

		$data['contents'] = 'templete_user/content/beritainfotemp';
		$this->load->view('templete_user/index',$data);
		$kode=$this->uri->segment(3);
		$kode1=$this->uri->segment(3);
		$data['a']=$this->uri->segment(3);
		$data['data1']=$this->user->get_berita_by_kode($kode);
		$data['data2']=$this->user->get_komentar_tbl_kd($kode1);
		$this->load->view('templete_user/content/beritainfodet',$data);
	}	
	function upload_b(){		
			date_default_timezone_set("Asia/Jakarta");
			$data['tanggal'] = date("Y-m-d");
			$data['kd_komentar'] = $_POST['kd_komentar'].'tbl_kd';
			$data['nama'] = $this->session->userdata('ses_nama');
			$data['isikomentar'] = $_POST['isi'];
			$data['photo'] = $this->session->userdata('ses_poto');

			$this->load->model('user');
			$this->user->save_komentar($data);
				$data['message'] = "uploaded";/*
			$data['contents'] = 'templete_user/content/beritainfotemp';
			$this->load->view('templete_user/index',$data);
			$x['data']=$this->user->get_all_berita();
			$this->load->view('templete_user/content/beritainfo',$x,$data);*/
			$a = $_POST['a'];
			echo $a;
			$url=base_url().'index.php/welcome_user/view/'.$a;
			redirect($url);

	}



















	public function alatkelengkapan()
	{
		$data['contents'] = 'templete_user/content/alatkelengkapan';
		$this->load->view('templete_user/index',$data);
	}
	public function beranda()
	{
		$data['contents'] = 'templete_user/content/beritainfo';
		$this->load->view('templete_user/index',$data);
	}
	

}
