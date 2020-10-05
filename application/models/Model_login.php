<?php
	class Model_login extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function cud($data){
			$sp = 'CALL sp_login_cud(?,?,?,?,?,?)';
			$q = $this->db->query($sp, $data);
			$res = $q->row();
			$q->next_result();
			$q->free_result();
			return $res->Result;
		}

		public function selectFullName($username){
			$this->db->select('FullName');
			$q = $this->db->get_where('login', array('username' => $username));
			$res = $q->row();
			return $res->FullName;
		}

		public function selectPassword($username){
			$this->db->select('Password');
			$q = $this->db->get_where('login', array('username' => $username));
			$res = $q->row();
			return $res->Password;
		}

		public function selectID($username){
			$this->db->select('ID_Login');
			$q = $this->db->get_where('login', array('username' => $username));
			$res = $q->row();
			return $res->ID_Login;
		}

		public function login($username, $pass){
			if(password_verify($pass, $this->selectPassword($username))){
				if($this->selectID($username)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function updatePassword($data){
            $sp = "CALL sp_change_password(?,?,?,?)";
            $q = $this->db->query($sp, $data);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->Result;
		}
	}
