<?php
class Login_model extends CI_Model{
	//cek nip dan password dosen
	function auth_($username,$password){
		$query=$this->db->query("SELECT * FROM tbl_user WHERE user='$username' AND password='$password' LIMIT 1");
		return $query;
	}


}





