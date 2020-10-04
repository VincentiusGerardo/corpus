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

        public function kembaliBuku($data){
            $sp = "CALL sp_pengembalian(?,?,?,?,?,?,?,?)";
            $q = $this->db->query($sp,$data);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->Result;
        }

        public function getLateReturn(){
            $sp = "CALL sp_pengembalian_terlambat()";
            $q = $this->db->query($sp);
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        public function getBookBorrowed($id){
            $sp = 'CALL sp_pengembalian_select_book(?)';
            $q = $this->db->query($sp, array('idBuku' => $id));
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        
    }