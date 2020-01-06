<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();

		
		if($this->session->userdata('akses') != "ADMIN"){
			$url=base_url();
			redirect($url);
		}


		$this->load->model('m_kd');
		$this->load->model('m_komentar');
		$this->load->model('m_saran');
		$this->load->model('m_hd');
		$this->load->model('m_order');
		$this->load->model('m_rencana_order');
		$this->load->model('m_user');
		$this->load->model('user');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('pdf');
	}

	public function index()
	{
		$data['contents'] = 'admin/content/dashboard';
		$this->load->view('admin/index',$data);
    }

	public function cetak_order($paper = 'a4', $orientation = 'portrait')
	{
		$this->pdf->folder('assets/pdf/');
		$filename = $paper.'-'.$orientation.'.pdf';
		$this->pdf->filename($filename);
		$this->pdf->paper($paper, $orientation);
		$data = array(
		'margin' => '40px',
		'title' => 'PDF Created '.ucfirst($paper).' '.ucfirst($orientation),
		'message' => 'Hello World!'
		);

		$tanggal1       = $_POST['tanggal1']; 
		$tanggal2       = $_POST['tanggal2']; 
		$data['title'] = 'Cetak PDF Data BAR'.$tanggal1."+".$tanggal2; 

		$data['cet'] = $this->user->get($tanggal1,$tanggal2); 

		$this->pdf->html($this->load->view('cetak', $data, true));
		/*        $this->load->view('cetak', $data);*/
		if($this->pdf->create('download')) {
		redirect();
		}

	}


////////////////     
    public function konten_desa()
	{
		$data['contents'] = 'admin/content/info_desa';
		$this->load->view('admin/index',$data);
    }

	public function ajax_list6()
	{
		$this->load->helper('url');

		$list = $this->m_kd->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_kd) {
			$row = array();
			$row[] = $no++;
			$row[] = $m_kd->tanggal;
			if($m_kd->photo)
			$row[] = '<a href="'.base_url('upload/'.$m_kd->photo).'" target="_blank"><img src="'.base_url('upload/'.$m_kd->photo).'" class="img-responsive"/></a>';
			else
				$row[] = '(No photo)';
			$row[] = $m_kd->judul;
			$row[] = $m_kd->isi;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_m_kd('."'".$m_kd->no."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_m_kd('."'".$m_kd->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_kd->count_all(),
						"recordsFiltered" => $this->m_kd->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit6($id)
	{
		$data = $this->m_kd->get_by_id($id);
		echo json_encode($data);
	}
/*
	public function ajax_add3()
	{
		$this->_validate();
		
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->m_alatk->save($data);

		echo json_encode(array("status" => TRUE));
	}*/

	public function ajax_update6()
	{
		$this->_validate6();
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload6();
			
			//delete file
			$m_kd = $this->m_kd->get_by_id($this->input->post('no'));
			if(file_exists('upload/'.$m_kd->photo) && $m_kd->photo)
				unlink('upload/'.$m_kd->photo);

			$data['photo'] = $upload;
		}

		$this->m_kd->update(array('no' => $this->input->post('no')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete6($id)
	{
		//delete file
		$m_kd = $this->m_kd->get_by_id($id);
		if(file_exists('upload/'.$m_kd->photo) && $m_kd->photo)
			unlink('upload/'.$m_kd->photo);
		
		$this->m_kd->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload6()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000000; // set max width image allowed
        $config['max_height']           = 1000000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate6()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('tanggal') == '')
		{
			$data['inputerror'][] = 'tanggal';
			$data['error_string'][] = 'tanggal is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('judul') == '')
		{
			$data['inputerror'][] = 'judul';
			$data['error_string'][] = 'judul is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('isi') == '')
		{
			$data['inputerror'][] = 'isi';
			$data['error_string'][] = 'isi is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}





//////////////// 

	public function tambah_info_desa()
	{
		$data['contents'] = 'admin/content/tambah_info_desa';
		$this->load->view('admin/index',$data);
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
			
			$data['tanggal'] = $_POST['tanggal'];
			$data['photo'] = $file_data['file_name'];
			$data['judul'] = $_POST['judul'];
			$data['isi'] = $_POST['isi'];


			$this->load->model('upload_images');
			$this->upload_images->save_image($data);
			
			$data['message'] = "Data Berhasil Di Posting";
		
		$data['contents'] = 'admin/content/tambah_info_desa';
		$this->load->view('admin/index',$data);
			}
			else
			{
			$data = array();	
			$this->load->model('upload_images');			
			$data['uploaded_images'] = $this->upload_images->get_images();
			
			$error = $this->upload->display_errors();
			$data['errors'] = $error;

		$data['contents'] = 'admin/content/tambah_info_desa';
		$this->load->view('admin/index',$data);
			}
	}














    public function kelola_komentar()
	{
		$data['contents'] = 'admin/content/komentar';
        $this->load->view('admin/index',$data);
    }
	public function ajax_list2()
	{
		$list = $this->m_komentar->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_komentar) {
			$row = array();			
            $row[] = $no++;
            $row[] = $m_komentar->kd_komentar;
            $row[] = $m_komentar->tanggal;
            $row[] = $m_komentar->nama;
            $row[] = $m_komentar->isikomentar;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Balas" onclick="edit_saran('."'".$m_komentar->no."'".')"><i class="glyphicon glyphicon-pencil"></i> Balas</a>
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_saran('."'".$m_komentar->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_komentar->count_all(),
						"recordsFiltered" => $this->m_komentar->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit2($id)
	{
		$data = $this->m_komentar->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update2()
	{
				date_default_timezone_set("Asia/Jakarta");
		$data = array(
				'kd_komentar' => $this->input->post('kd_komentar'),
				'tanggal' => date("Y-m-d"),
				'nama' => "ADMIN",
				'photo' => "a3ce5236fbf6c2abaf73f5c34518f8be.jpg",
				'isikomentar' => "<b>@".$this->input->post('nama')."</b>"." ".$this->input->post('isikomentar'),
				);
		$insert = $this->m_komentar->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete2($id)
	{
		$this->m_komentar->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

////////////////




    public function kelola_saran()
	{
		$data['contents'] = 'admin/content/saran';
		$this->load->view('admin/index',$data);
    }
	public function ajax_list()
	{
		$list = $this->m_saran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_saran) {
			$row = array();			
            $row[] = $no++;
            $row[] = $m_saran->tanggal;
            $row[] = $m_saran->nama;
            $row[] = $m_saran->isisaran;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_saran('."'".$m_saran->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_saran->count_all(),
						"recordsFiltered" => $this->m_saran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_delete($id)
	{
		$this->m_saran->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

////////////////









    public function hasil_desa()
	{
		$data['contents'] = 'admin/content/hasil_desa';
		$this->load->view('admin/index',$data);
    }


	public function ajax_list3()
	{
		$this->load->helper('url');

		$list = $this->m_hd->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_hd) {
			$row = array();
			$row[] = $no++;
			$row[] = $m_hd->tanggal;
			if($m_hd->photo)
			$row[] = '<a href="'.base_url('upload/'.$m_hd->photo).'" target="_blank"><img src="'.base_url('upload/'.$m_hd->photo).'" class="img-responsive"/></a>';
			else
				$row[] = '(No photo)';
			$row[] = $m_hd->judul;
			$row[] = $m_hd->isi;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_m_hd('."'".$m_hd->no."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_m_hd('."'".$m_hd->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_hd->count_all(),
						"recordsFiltered" => $this->m_hd->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit3($id)
	{
		$data = $this->m_hd->get_by_id($id);
		echo json_encode($data);
	}
/*
	public function ajax_add3()
	{
		$this->_validate();
		
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->m_alatk->save($data);

		echo json_encode(array("status" => TRUE));
	}*/

	public function ajax_update3()
	{
		$this->_validate3();
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload3();
			
			//delete file
			$m_hd = $this->m_hd->get_by_id($this->input->post('no'));
			if(file_exists('upload/'.$m_hd->photo) && $m_hd->photo)
				unlink('upload/'.$m_hd->photo);

			$data['photo'] = $upload;
		}

		$this->m_hd->update(array('no' => $this->input->post('no')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete3($id)
	{
		//delete file
		$m_hd = $this->m_hd->get_by_id($id);
		if(file_exists('upload/'.$m_hd->photo) && $m_hd->photo)
			unlink('upload/'.$m_hd->photo);
		
		$this->m_hd->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload3()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000000; // set max width image allowed
        $config['max_height']           = 1000000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate3()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('tanggal') == '')
		{
			$data['inputerror'][] = 'tanggal';
			$data['error_string'][] = 'tanggal is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('judul') == '')
		{
			$data['inputerror'][] = 'judul';
			$data['error_string'][] = 'judul is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('isi') == '')
		{
			$data['inputerror'][] = 'isi';
			$data['error_string'][] = 'isi is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}



	public function tambah_hasil_desa()
	{
		$data['contents'] = 'admin/content/tambah_hasil_desa';
		$this->load->view('admin/index',$data);
    }


		function upload1(){

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
			
			$data['tanggal'] = $_POST['tanggal'];
			$data['photo'] = $file_data['file_name'];
			$data['judul'] = $_POST['judul'];
			$data['isi'] = $_POST['isi'];


			$this->load->model('upload_images');
			$this->upload_images->save_image1($data);
			
			$data['message'] = "Data Berhasil Di Posting";
		
		$data['contents'] = 'admin/content/tambah_hasil_desa';
		$this->load->view('admin/index',$data);
			}
			else
			{
			$data = array();	
			$this->load->model('upload_images');			
			$data['uploaded_images'] = $this->upload_images->get_images();
			
			$error = $this->upload->display_errors();
			$data['errors'] = $error;

		$data['contents'] = 'admin/content/tambah_hasil_desa';
		$this->load->view('admin/index',$data);
			}
	}


    public function kelola_order()
	{
		$data['contents'] = 'admin/content/kelola_order';
		$this->load->view('admin/index',$data);
	}













	public function ajax_list5()
	{
		$list = $this->m_rencana_order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_rencana_order) {
			$row = array();			
            $row[] = $no++;
            $row[] = $m_rencana_order->id_order;
            $row[] = $m_rencana_order->tanggal;
            $row[] = $m_rencana_order->nama;
            $row[] = $m_rencana_order->no_hp;
            $row[] = $m_rencana_order->alamat;
            $row[] = $m_rencana_order->produk;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="STUJUI" onclick="delete_order('."'".$m_rencana_order->no."'".')"><i class="glyphicon glyphicon-pencil"></i> STUJUI</a>';

		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_rencana_order->count_all(),
						"recordsFiltered" => $this->m_rencana_order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_update5($id)
	{
		$data = array(
				'kun' => "2",
			);
		$this->m_rencana_order->update(array('no' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}



































	public function rekap_order()
	{
		$data['contents'] = 'admin/content/rekap_order';
		$this->load->view('admin/index',$data);
    }
	public function ajax_list4()
	{
		$list = $this->m_order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_order) {
			$row = array();			
            $row[] = $no++;
            $row[] = $m_order->id_order;
            $row[] = $m_order->tanggal;
            $row[] = $m_order->nama;
            $row[] = $m_order->no_hp;
            $row[] = $m_order->alamat;
            $row[] = $m_order->produk;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_order('."'".$m_order->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all(),
						"recordsFiltered" => $this->m_order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_delete4($id)
	{
		$this->m_order->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}




































    public function kelola_akun()
	{
		$data['contents'] = 'admin/content/kelola_akun';
		$this->load->view('admin/index',$data);
    }


	public function ajax_list7()
	{
		$list = $this->m_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $m_user) {
			$row = array();			
            $row[] = $no++;
            $row[] = $m_user->user;
            $row[] = $m_user->password;
            $row[] = $m_user->level;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_m_user('."'".$m_user->no."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
/*		<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_m_user('."'".$m_user->no."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>*/
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_user->count_all(),
						"recordsFiltered" => $this->m_user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

/*	public function ajax_edit7($id)
	{
		$data = $this->m_user->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add7()
	{
		$data = array(
				'user' => $this->input->post('user'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
			);
		$insert = $this->m_user->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update7()
	{
		$data = array(
				'user' => $this->input->post('user'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
			);
		$this->m_user->update(array('no' => $this->input->post('no')), $data);
		echo json_encode(array("status" => TRUE));
	}*/

	public function ajax_delete7($id)
	{
		$this->m_user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}








































        public function login()
	{
		$data['contents'] = 'admin/content/login';
        $this->load->view('admin/login_admin',$data);
    }
    public function daftar()
	{
		$data['contents'] = 'admin/content/daftar';
		$this->load->view('admin/login_admin',$data);
	}
	
	
	
	

}
