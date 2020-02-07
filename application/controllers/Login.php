<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller{
        public function __construct(){
            parent::__construct();
        }

        public function index(){
            $this->load->view('login');
        }

        public function doLogin(){
            echo "This is login process";
        }

        public function doLogout(){

        }
    }