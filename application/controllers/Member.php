<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Member extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('isLogged')){
                redirect('/','refresh');
            }
            $this->load->model('Model_member', 'mMember');
        }

        public function index(){
            $data['member'] = $this->mMember->getAllMember();
            $data['nextNum'] = $this->mMember->getMemberNextID();
            $this->load->view('header');
            $this->load->view('members', $data);
            $this->load->view('footer');
        }

        public function addMember(){
            $this->form_validation->set_rules('idMember', 'Member ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaMember', 'Member Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('hpMember', 'Member Phone Number', 'trim|required|xss_clean|max_length[15]|numeric');
            $this->form_validation->set_rules('alamatMember', 'Member Address', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idMember' => $this->input->post('idMember'),
                    'NamaMember' => $this->input->post('namaMember'),
                    'noHP' => $this->input->post('hpMember'),
                    'alamat' => $this->input->post('alamatMember'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flagActive' => null
                );
                if($this->mMember->cud($data) == 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Member Inserted!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg','Member can not be inserted!');
                    redirect($this->agent->referrer(), 'refresh');
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg','Member can not be inserted!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }

        public function updateMember(){
            $this->form_validation->set_rules('idMember', 'Member ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaMember', 'Member Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('hpMember', 'Member Phone Number', 'trim|required|xss_clean|max_length[15]|numeric');
            $this->form_validation->set_rules('alamatMember', 'Member Address', 'trim|required|xss_clean');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idMember' => $this->input->post('idMember'),
                    'NamaMember' => $this->input->post('namaMember'),
                    'noHP' => $this->input->post('hpMember'),
                    'alamat' => $this->input->post('alamatMember'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flagActive' => 1
                );
                
                if($this->mMember->cud($data) == 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Member Updated!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg','Member can not be updated!');
                    redirect($this->agent->referrer(), 'refresh');
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg','Member can not be updated!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }

        public function deleteMember(){
            $this->form_validation->set_rules('idMember', 'Member ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaMember', 'Member Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('hpMember', 'Member Phone Number', 'trim|required|xss_clean|max_length[15]|numeric');
            $this->form_validation->set_rules('alamatMember', 'Member Address', 'trim|required|xss_clean');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idMember' => $this->input->post('idMember'),
                    'NamaMember' => $this->input->post('namaMember'),
                    'noHP' => $this->input->post('hpMember'),
                    'alamat' => $this->input->post('alamatMember'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flagActive' => 0
                );
                
                if($this->mMember->cud($data) == 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Member Deleted!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg','Member can not be deleted!');
                    redirect($this->agent->referrer(), 'refresh');
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg','Member can not be deleted!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }
    }