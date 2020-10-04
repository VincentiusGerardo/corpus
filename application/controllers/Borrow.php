<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Borrow extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogged')) {
            redirect('/', 'refresh');
        }
        $this->load->model('Model_PinjamKembali', 'mPinjamKembali');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('borrow');
        $this->load->view('footer');
    }

    public function insertBorrow()
    {
        $this->form_validation->set_rules('member', 'Member Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('book1', 'Book 1', 'trim|required|xss_clean');
        $this->form_validation->set_rules('book2', 'Book 2', 'trim|xss_clean');
        $this->form_validation->set_rules('tPinjam', 'Tanggal Pinjam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tKembali', 'Tanggal Kembali', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('book2')) {
                $data = array(
                    'idPeminjaman' => null,
                    'idBuku' => $this->input->post('book1'),
                    'idMember' => $this->input->post('member'),
                    'TanggalPinjam' => $this->input->post('tPinjam'),
                    'TanggalKembali' => $this->input->post('tKembali'),
                    'flagKembali' => false,
                    'currentUser' => $this->session->userdata('fullname')
                );

                $data2 = array(
                    'idPeminjaman' => null,
                    'idBuku' => $this->input->post('book2'),
                    'idMember' => $this->input->post('member'),
                    'TanggalPinjam' => $this->input->post('tPinjam'),
                    'TanggalKembali' => $this->input->post('tKembali'),
                    'flagKembali' => false,
                    'currentUser' => $this->session->userdata('fullname')
                );

                if ($this->mPinjamKembali->pinjamBuku($data) && $this->mPinjamKembali->pinjamBuku($data2)) {
                    $this->session->set_flashdata('alert', 'success');
                    $this->session->set_flashdata('msg', 'Book(s) Borrowed!');
                    redirect($this->agent->referrer(), 'refresh');
                } else {
                    $this->session->set_flashdata('alert', 'error');
                    $this->session->set_flashdata('msg', 'Book can not be Borrowed');
                    redirect($this->agent->referrer(), 'refresh');
                }
            } else {
                $data = array(
                    'idPeminjaman' => null,
                    'idBuku' => $this->input->post('book1'),
                    'idMember' => $this->input->post('member'),
                    'TanggalPinjam' => $this->input->post('tPinjam'),
                    'TanggalKembali' => $this->input->post('tKembali'),
                    'flagKembali' => 0,
                    'currentUser' => $this->session->userdata('fullname')
                );

                if ($this->mPinjamKembali->pinjamBuku($data)) {
                    $this->session->set_flashdata('alert', 'success');
                    $this->session->set_flashdata('msg', 'Book(s) Borrowed!');
                    redirect($this->agent->referrer(), 'refresh');
                } else {
                    $this->session->set_flashdata('alert', 'error');
                    $this->session->set_flashdata('msg', 'Book can not be Borrowed');
                    redirect($this->agent->referrer(), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('alert', 'error');
            $this->session->set_flashdata('msg', 'Please Fill Member Information and First Book Detail');
            redirect($this->agent->referrer(), 'refresh');
        }
    }

    public function insertReturn()
    {
        $this->form_validation->set_rules('bookID', 'Book ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('memberName', 'Member Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('duration', 'Loan Duration', 'trim|xss_clean');
        $this->form_validation->set_rules('denda', 'Loan Fine', 'trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('denda')) {
                $data = array(
                    'idPeminjaman' => $this->input->post('idPeminjaman'),
                    'idBuku' => $this->input->post('bookID'),
                    'memberName' => $this->input->post('memberName'),
                    'returnDate' => $this->input->post('returnDate'),
                    'isLate' => 1,
                    'totalDays' => $this->input->post('duration'),
                    'totalFine' => $this->input->post('denda'),
                    'currentUser' => $this->session->userdata('fullname')
                );
            } else {
                $data = array(
                    'idPeminjaman' => $this->input->post('idPeminjaman'),
                    'idBuku' => $this->input->post('bookID'),
                    'memberName' => $this->input->post('memberName'),
                    'returnDate' => $this->input->post('returnDate'),
                    'isLate' => 0,
                    'totalDays' => $this->input->post('duration'),
                    'totalFine' => 0,
                    'currentUser' => $this->session->userdata('fullname')
                );
            }

            if($this->mPinjamKembali->kembaliBuku($data)){
                $this->session->set_flashdata('alert', 'success');
                $this->session->set_flashdata('msg', 'Book Returned!');
                redirect($this->agent->referrer(), 'refresh');
            }else{

            }
        } else {
            $this->session->set_flashdata('alert', 'error');
            $this->session->set_flashdata('msg', 'Book can not be returned');
            redirect($this->agent->referrer(), 'refresh');
        }
    }

    public function returnLoan()
    {
        $this->load->view('header');
        $this->load->view('return');
        $this->load->view('footer');
    }

    public function lateReturn(){
        $data['lr'] = $this->mPinjamKembali->getLateReturn();
        $this->load->view('header');
        $this->load->view('latereturn', $data);
        $this->load->view('footer');
    }
}
