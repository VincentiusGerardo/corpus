<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_book extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function cud($data){
            $sp = "CALL sp_books_cud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $q = $this->db->query($sp, $data);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->Result;
        }

        public function getNextID(){
            $sp = 'CALL sp_book_get_next_id()';
            $q = $this->db->query($sp);
            $res = $q->row();
			$q->next_result();
            $q->free_result();
            return $res->NewID;
        }
        
        public function getAllBook(){
            $sp = "CALL sp_book_select_all()";
            $q = $this->db->query($sp);
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        public function getBookDetail($id){
            $sp = 'CALL sp_book_detail(?)';
            $q = $this->db->query($sp, array('idBuku' => $id));
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }

        public function getBookCategory(){
            $sp = "CALL sp_book_get_kategori()";
            $q = $this->db->query($sp);
            $res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }
    }