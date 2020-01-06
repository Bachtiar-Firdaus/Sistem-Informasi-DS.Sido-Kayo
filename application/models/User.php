<?php 
Class User extends CI_Model{

	function save($data){		
		$this->db->insert('tbl_saran',$data);
	}	
	function save_komentar($data){		
		$this->db->insert('tbl_komentar',$data);
	}	
	function save_order($data){		
		$this->db->insert('tbl_order',$data);
	}
	function save_saran($data){		
		$this->db->insert('tbl_saran',$data);
	}
	public function get($tanggal1,$tanggal2){
		$hsl=$this->db->query("SELECT * FROM tbl_order WHERE tanggal >= '$tanggal1' AND tanggal <= '$tanggal2' AND kun = '2'");
		return $hsl->result();
	}

	
	public function get_berita_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_kd WHERE no='$kode'");
		return $hsl;
	}
    public function get_komentar_tbl_kd($kode1){
    	$h=$kode1.'tbl_kd';
    	$hsl = $this->db->query("SELECT * FROM tbl_komentar WHERE KD_KOMENTAR='$h'");
        return $hsl->result();
    }
	public function get_all_berita(){
		$hsl=$this->db->query("SELECT * FROM tbl_kd ORDER BY no DESC");
		return $hsl;
	}







	public function get_berita_by_kode1($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_hd WHERE no='$kode'");
		return $hsl;
	}
    public function get_komentar_tbl_hd($kode1){
    	$h=$kode1.'tbl_hd';
    	$hsl = $this->db->query("SELECT * FROM tbl_komentar WHERE KD_KOMENTAR='$h'");
        return $hsl->result();
    }
	public function get_all_berita1(){
		$hsl=$this->db->query("SELECT * FROM tbl_hd ORDER BY no DESC");
		return $hsl;
	}











}
?>