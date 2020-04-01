<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Book extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('isLogged')){
                redirect('/','refresh');
            }
            $this->load->model('Model_book', 'mBook');
        }

        public function index(){
            $data['book'] = $this->mBook->getAllBook();
            $data['nextNum'] = $this->mBook->getNextID();
            $data['category'] = $this->mBook->getBookCategory();
            $this->load->view('header');
            $this->load->view('books', $data);
            $this->load->view('footer');
        }
        
        public function addBook(){
            $this->form_validation->set_rules('idBook', 'Book ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaBook', 'Book Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenulis', 'Author', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenerbit', 'Publisher', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tahunTerbit', 'Year', 'trim|required|xss_clean|max_length[4]');
            $this->form_validation->set_rules('idKlasifikasi', 'Classification', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idCategory', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idISBN', 'ISBN', 'trim|required|xss_clean|max_length[15]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
            $this->form_validation->set_rules('serial', 'Serial Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vol', 'Volume', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idBuku' => $this->input->post('idBook'),
                    'namaBuku'=> $this->input->post('namaBook'),
                    'namaPengarang'=> $this->input->post('namaPenulis'),
                    'namaPenerbit'=> $this->input->post('namaPenerbit'),
                    'tahunTerbit'=> $this->input->post('tahunTerbit'),
                    'idKlasifikasi'=> $this->input->post('idKlasifikasi'),
                    'flagPinjam' => 0,
                    'idKategori'=> $this->input->post('idCategory'),
                    'idISBN'=> $this->input->post('idISBN'),
                    'unitPrice'=> str_replace(',','',$this->input->post('price')),
                    'serialNumber'=> $this->input->post('serial'),
                    'idJilid'=> $this->input->post('vol'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flag' => null
                );
                // print_r($data);
                if($this->mBook->cud($data)== 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Book Inserted!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg', 'Book can not be inserted!');
                    redirect($this->agent->referrer(), 'refresh');  
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg', 'Book can not be inserted!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }

        public function updateBook(){
            $this->form_validation->set_rules('idBook', 'Book ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaBook', 'Book Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenulis', 'Author', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenerbit', 'Publisher', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tahunTerbit', 'Year', 'trim|required|xss_clean|max_length[4]');
            $this->form_validation->set_rules('idKlasifikasi', 'Classification', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idCategory', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idISBN', 'ISBN', 'trim|required|xss_clean|max_length[15]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
            $this->form_validation->set_rules('serial', 'Serial Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vol', 'Volume', 'trim|required|xss_clean');
            $this->form_validation->set_rules('statusBuku', 'Book Status', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idBuku' => $this->input->post('idBook'),
                    'namaBuku'=> $this->input->post('namaBook'),
                    'namaPengarang'=> $this->input->post('namaPenulis'),
                    'namaPenerbit'=> $this->input->post('namaPenerbit'),
                    'tahunTerbit'=> $this->input->post('tahunTerbit'),
                    'idKlasifikasi'=> $this->input->post('idKlasifikasi'),
                    'flagPinjam' => $this->input->post('statusBuku'),
                    'idKategori'=> $this->input->post('idCategory'),
                    'idISBN'=> $this->input->post('idISBN'),
                    'unitPrice'=> str_replace(',','',$this->input->post('price')),
                    'serialNumber'=> $this->input->post('serial'),
                    'idJilid'=> $this->input->post('vol'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flag' => 1
                );
                //print_r($data);
                if($this->mBook->cud($data)== 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Book updated!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg', 'Book can not be updated!');
                    redirect($this->agent->referrer(), 'refresh');  
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg', 'Book can not be updated!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }

        public function deleteBook(){
            $this->form_validation->set_rules('idBook', 'Book ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaBook', 'Book Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenulis', 'Author', 'trim|required|xss_clean');
            $this->form_validation->set_rules('namaPenerbit', 'Publisher', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tahunTerbit', 'Year', 'trim|required|xss_clean|max_length[4]');
            $this->form_validation->set_rules('idKlasifikasi', 'Classification', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idCategory', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idISBN', 'ISBN', 'trim|required|xss_clean|max_length[15]');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
            $this->form_validation->set_rules('serial', 'Serial Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vol', 'Volume', 'trim|required|xss_clean');
            $this->form_validation->set_rules('statusBuku', 'Book Status', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'idBuku' => $this->input->post('idBook'),
                    'namaBuku'=> $this->input->post('namaBook'),
                    'namaPengarang'=> $this->input->post('namaPenulis'),
                    'namaPenerbit'=> $this->input->post('namaPenerbit'),
                    'tahunTerbit'=> $this->input->post('tahunTerbit'),
                    'idKlasifikasi'=> $this->input->post('idKlasifikasi'),
                    'flagPinjam' => $this->input->post('statusBuku'),
                    'idKategori'=> $this->input->post('idCategory'),
                    'idISBN'=> $this->input->post('idISBN'),
                    'unitPrice'=> str_replace(',','',$this->input->post('price')),
                    'serialNumber'=> $this->input->post('serial'),
                    'idJilid'=> $this->input->post('vol'),
                    'currentUser' => $this->session->userdata('fullname'),
                    'flag' => 0
                );
                //print_r($data);
                if($this->mBook->cud($data)== 1){
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg','Book deleted!');
                    redirect($this->agent->referrer(), 'refresh');
                }else{
                    $this->session->set_flashdata('alert','error');
                    $this->session->set_flashdata('msg', 'Book can not be deleted!');
                    redirect($this->agent->referrer(), 'refresh');  
                }
            } else {
                $this->session->set_flashdata('alert','error');
                $this->session->set_flashdata('msg', 'Book can not be deleted!');
                redirect($this->agent->referrer(), 'refresh');
            }
        }

        public function inventory(){

        }
    }