<?php
	class Model_home extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function cud($data){
			$sp = 'CALL sp_cud_karyawan(?,?,?,?,?)';
			$q = $this->db->query($sp,$data);
			$res = $q->result();
			return $res;
		}

		public function karyawan(){
			$sp = 'CALL getDetailKaryawan()';
			$q = $this->db->query($sp);
			$res = $q->result();
			return $res;
		}
	}
