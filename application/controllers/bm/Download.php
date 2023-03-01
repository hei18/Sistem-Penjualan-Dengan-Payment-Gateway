<?php
defined('BASEPATH') or exit('No direct script access allowed');
#require FCPATH.'/vendor/autoload.php';
class Download extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->library('form_validation');
		$this->load->library('pdf');

		$this->load->helper('download');

		$this->load->model('mdl_bm', 'user');
		$this->load->model('mdl_bm', 'users');
		$this->load->model('mdl_bm', 'checkProductId');
		$this->load->model('mdl_bm', 'displayBeat');
		$this->load->library('encryption');
	}

	public function index()
	{
		$this->load->view('none');
	}

	public function d()
	{


		$id_user = $this->input->get('uid');
		$pdf = $this->input->get('pdf');
		$define_id = base64_decode($id_user);
		$user = $this->db->get_where('user', ['id_user' => $define_id])->row();
		// $user = $this->user->getByIdBm($define_id);
		#ini_set('display_errors', 'off');
		// if ($define_id == $user['id_user']) {
		// 	force_download('files/pdf/' . $pdf, NULL);
		// 	exit;
		// } elseif ($user == NULL) {
		// 	$this->load->view('none');
		// }


		if ($user != NULL) {
			force_download('files/pdf/' . $pdf, NULL);
		} elseif ($user == NULL) {
			$this->load->view('none');
		}

		// var_dump($user);
	}
}
