<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Model_login', 'mLogin');
        }

        public function index(){
            if($this->session->userdata('isLogged')){
                redirect('/Module/', 'refresh');
            }else{
                $this->load->view('login');
            }
        }

        public function doLogin(){
            $this->form_validation->set_rules('inputUser', 'Username', 'required|trim|xss_clean');
            $this->form_validation->set_rules('inputPass', 'Password', 'required|trim|xss_clean');
            if($this->form_validation->run()){
                $user = $this->input->post('inputUser');
                $pass = $this->input->post('inputPass');
                
                $r = $this->mLogin->login($user, $pass);

                if($r){
                    $data = array(
                        'isLogged' => true,
                        'username' => $user,
                        'userid' => $this->mLogin->selectID($user),
                        'fullname' => $this->mLogin->selectFullName($user)
                    );
                    $this->session->set_userdata($data);
                    redirect('/Module/','refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg','Invalid username or password!');
                    redirect('/');
                }
            }else{
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg','Invalid username or password!');
                redirect('/');
            }
        }

        public function doLogout(){
            $this->session->sess_destroy();
            redirect('/','refresh');
        }
    }