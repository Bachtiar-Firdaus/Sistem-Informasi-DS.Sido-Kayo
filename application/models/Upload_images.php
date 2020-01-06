<?php 
Class upload_images extends CI_Model{

	function save_image($data){		
		$this->db->insert('tbl_kd',$data);
	}

	function save_image1($data){		
		$this->db->insert('tbl_hd',$data);
	}
	function save_image2($data){		
		$this->db->insert('tbl_user',$data);
	}/*
	function save_image2($data){		
		$this->db->insert('tbl_p',$data);
	}
	function save_image3($data){		
		$this->db->insert('tbl_b',$data);
	}*/
	
	function get_images(){
		$this->db->from('uploaded_images');
		$this->db->order_by('date_uploaded', 'asc');
		$query = $this->db->get();
		
		return $query->result();		

	}

}
?>