<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_member extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function cud($data){
            $sp = "CALL sp_member_cud(?,?,?,?,?,?)";
            $q = $this->db->query($sp, $data);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->Result;
        }

        public function getAllMember(){
            $sp = "CALL sp_member_select_all()";
            $q = $this->db->query($sp);
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        public function getMemberByID($id){
            $sp = "CALL sp_member_select_by_id(?)";
            $q = $this->db->query($sp, array('idMember' => $id));
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        public function getMemberNextID(){
            $sp = "CALL sp_member_get_next_id()";
            $q = $this->db->query($sp);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->NewID;
        }
    }