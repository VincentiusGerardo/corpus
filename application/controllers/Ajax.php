<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Ajax extends CI_Controller{
        public function __construct(){
            parent::__construct();
            // if(!$this->session->userdata('isLogged')){
            //     redirect('/','refresh');
            // }
            $this->load->model('Model_book', 'mBook');
            $this->load->model('Model_member', 'mMember');
            $this->load->model('Model_PinjamKembali', 'mPinjamKembali');
            $this->load->model('Model_history', 'mHistory');
        }

        public function index(){
            $this->load->view('error404');
        }

        public function getUser(){
            $user = $this->input->post('memberID');
            $data['res'] = $this->mMember->getMemberByID($user);
            $this->load->view('ajax/ajaxmember', $data);
        }

        public function getBookDetail(){
            $bookID = $this->input->post('book');
            $data['res'] = $this->mBook->getBookDetail($bookID);
            $this->load->view('ajax/ajaxbook', $data);
        }

        public function getBookDetailWithFine(){
            $bookID = $this->input->post('book');
            $data['res'] = $this->mPinjamKembali->getBookBorrowed($bookID);
            $this->load->view('ajax/ajaxfine', $data);
        }

        public function getHistory(){            
            $code = $this->input->post('historyCode');
            $data['res'] = $this->mHistory->getHistoryBySelection($code);
            $this->load->view('ajax/ajaxhistory', $data);
        }
    }