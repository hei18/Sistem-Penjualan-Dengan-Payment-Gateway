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

		$this->load->model('mdl_cs', 'user');

		$this->load->library('encryption');
	}

	public function index()
	{
		$this->load->view('none');
	}

	public function d()
	{


		$id_cs = $this->input->get('uid');
		$pdf = $this->input->get('pdf');
		$define_id = base64_decode($id_cs);
		$user = $this->db->get_where('customer', ['id_cs' => $define_id])->row();


		if ($user != NULL) {
			force_download('files/pdf/' . $pdf, NULL);
		} elseif ($user == NULL) {
			$this->load->view('none-cs');
		}

		// var_dump($user);
	}

	public function bill()
	{
		$get_idHistory = $this->input->get('id');
		$get_Token = $this->input->get('token');
		// var_dump($get_Token);
		// die;
		$get_Audio = $this->input->get('file');
		$define_idHistory = @base64_decode($get_idHistory);
		$define_Audio = @base64_decode($get_Audio);

		$param = $this->db->get_where(
			'order_history',
			[
				'id_history' => $define_idHistory,

			]
		)->row();

		if ($param->id_history == $define_idHistory && $param->file_token == $get_Token) {
			if ($define_Audio == $param->full_version) {
				force_download('files/full/' . $define_Audio, NULL);
			}
		}

		// die;
		// if ($param->id_history == $define_idHistory && $param->file_token == $get_Token) {
		// 	echo 'kesini';
		// 	// $data = [
		// 	// 	'file_token' => null,
		// 	// ];
		// 	// $this->user->updateByIdOrder($define_idHistory, $data);
		// 	// if ($define_Audio == $param->full_version) {
		// 	// 	force_download('files/full/' . $define_Audio, NULL);
		// 	// }
		// }

		// if ($get_idHistory == NULL && $get_Token == NULL && $get_Audio == NULL) {
		// 	if ($define_idHistory == NULL && $define_Audio == NULL) {
		// 		$this->load->view('none');
		// 	}
		// } elseif ($param->id_history == $define_idHistory && $param->file_token == $get_Token) {
		// 	$data = [
		// 		'file_token' => null,
		// 	];
		// 	$this->user->updateByIdOrder($define_idHistory, $data);
		// 	if ($define_Audio == $param->full_version) {
		// 		force_download('files/full/' . $define_Audio, NULL);
		// 	}
		// } elseif ($param->id_history == $define_idHistory && $param->file_token == NULL) {
		// 	$this->load->view('not-found');
		// }


	}
}
