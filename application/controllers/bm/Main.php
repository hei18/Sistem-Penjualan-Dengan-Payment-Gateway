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
    }
}
