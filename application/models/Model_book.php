<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_book extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function getAllBook(){
            $sp = "CALL sp_select_all_book()";
            $q = $this->db->query($sp);
            $res = $q->result();
            return $res;
        }

        public function cud($data){
            $sp = "CALL sp_books_cud()";
            $q = $this->db->query($sp, $data);
            $res = $q->result();
            return $res;
        }
    }