<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Borrow extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('isLogged')){
                redirect('/','refresh');
            }
        }

        public function index(){
            $this->load->view('header');
            //$this->load->view('borrow2');
            $this->load->view('borrow');
            $this->load->view('footer');
        }

        public function insertBorrow(){

        }

        public function insertReturn(){
            
        }
    }