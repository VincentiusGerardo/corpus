<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('isLogged')){
                redirect('/','refresh');
            }
        }

        public function index(){
            $this->load->view('header');
            $this->load->view('home');
            $this->load->view('footer');
        }

        public function history(){
            $this->load->model('Model_history', 'mHistory');
            $data['his'] = $this->mHistory->getHistory(array('historyCode' => '', 'historyDetailCode' => ''));
            $this->load->view('header');
            $this->load->view('history', $data);
            $this->load->view('footer');
        }
    }