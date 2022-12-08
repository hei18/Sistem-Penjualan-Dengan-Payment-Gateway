<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        as_bm();
        $this->load->model('mdl_bm', 'user');
        $this->load->model('mdl_artist', 'artist');
        $this->load->model('mdl_artist', 'getProduct');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index()

    {
        $id_user = $this->session->userdata('id_user');
        $fetch['user'] = $this->user->getById($id_user);
        $fetch['getProduct'] = $this->getProduct->getAllProductToDisplay();
        $fetch['getBm'] = $this->getProduct->getBeatMaker();
        $this->load->view('layout/main-header-bm', $fetch);
        $this->load->view('bm/home');
        $this->load->view('layout/main-footer-bm');
    }
}
