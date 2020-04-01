<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_PinjamKembali extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function pinjamBuku($data){
            $sp = "CALL sp_peminjaman(?,?,?,?,?,?,?)";
            $q = $this->db->query($sp,$data);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->Result;
        }

        public function getAllPeminjaman(){

        }

        public function getLateReturn(){

        }

        
    }