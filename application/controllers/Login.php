<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'mLogin');
    }

    public function index()
    {
        if ($this->session->userdata('isLogged')) {
            redirect('/Module/', 'refresh');
        } else {
            $this->load->view('login');
        }
    }

    public function doLogin()
    {
        $this->form_validation->set_rules('inputUser', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('inputPass', 'Password', 'required|trim|xss_clean');
        if ($this->form_validation->run()) {
            $user = $this->input->post('inputUser');
            $pass = $this->input->post('inputPass');

            $r = $this->mLogin->login($user, $pass);

            if ($r) {
                $data = array(
                    'isLogged' => true,
                    'username' => $user,
                    'userid' => $this->mLogin->selectID($user),
                    'fullname' => $this->mLogin->selectFullName($user)
                );
                $this->session->set_userdata($data);
                redirect('/Module/', 'refresh');
            } else {
                $this->session->set_flashdata('alert', 'error');
                $this->session->set_flashdata('msg', 'Invalid username or password!');
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('alert', 'error');
            $this->session->set_flashdata('msg', 'Invalid username or password!');
            redirect('/');
        }
    }

    public function doLogout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    public function changePassword()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('currPass', 'Old Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('newPass', 'New Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('repeatPass', 'Repeat Password', 'trim|required|xss_clean');


        if ($this->form_validation->run() == TRUE) {
            $user = $this->input->post('username');
            $oldPass = $this->input->post('currPass');
            $newPass = $this->input->post('newPass');
            $repPass = $this->input->post('repeatPass');

            if ($this->mLogin->login($user, $oldPass)) {
                if ($oldPass === $newPass) {
                    $this->session->set_flashdata('alert', 'error');
                    $this->session->set_flashdata('msg', 'New Password cannot be the same as old!');
                    redirect($this->agent->referrer(), 'refresh');
                } else if (strlen($newPass) < 8) {
                    $this->session->set_flashdata('alert', 'error');
                    $this->session->set_flashdata('msg', 'New Password must be at least 8 characters!');
                    redirect($this->agent->referrer(), 'refresh');
                } else if ($repPass !== $newPass) {
                    $this->session->set_flashdata('alert', 'error');
                    $this->session->set_flashdata('msg', 'New Password and Confirm Password does not match!');
                    redirect($this->agent->referrer(), 'refresh');
                } else {
                    $data = array(
                        'idMember' => $this->session->userdata('userid'),
                        'userName' => $user,
                        'newPassword' => password_hash($newPass, PASSWORD_DEFAULT),
                        'currentUser' => $this->session->userdata('fullname')
                    );

                    if($this->mLogin->updatePassword($data) == 1){
                        $this->session->set_flashdata('alert','success');
                        $this->session->set_flashdata('msg','Password Changed!');
                        redirect($this->agent->referrer(), 'refresh');
                    }else{
                        $this->session->set_flashdata('alert', 'error');
                        $this->session->set_flashdata('msg', 'Can not change password!');
                        //redirect($this->agent->referrer(), 'refresh');
                    }
                }
            } else {
                $this->session->set_flashdata('alert', 'error');
                $this->session->set_flashdata('msg', 'Invalid Password!');
                redirect($this->agent->referrer(), 'refresh');
            }
        } else {
            $this->session->set_flashdata('alert', 'error');
            $this->session->set_flashdata('msg', 'Can not change password!');
            redirect($this->agent->referrer(), 'refresh');
        }
    }
}
