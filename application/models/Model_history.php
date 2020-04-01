<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_history extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function getHistory($data){
            $sp = 'CALL sp_history_select(?,?)';
            $q = $this->db->query($sp, $data);
			$res = $q->result();
			$q->next_result();
            $q->free_result();
            return $res;
        }
    }