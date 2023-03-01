<?php
defined('BASEPATH') or exit('No direct script access allowed');
#require FCPATH.'/vendor/autoload.php';
class Re_Create extends CI_Controller
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
		$get_email = $this->input->get('q');
		$get_password = $this->input->get('key');

		$define_email = base64_decode($get_email);
		$define_password = base64_decode($get_password);

		// var_dump($define_email);
		// var_dump($define_password);

		$data = $this->db->get_where(
			'user',
			[
				'email' => $define_email,
				'password' => $define_password
			]
		)->row();
		$id_user = $data->id_user;
		$nickname = $data->nickname;
		$role = $data->role;
		if ($data->password == $define_password && $data->email == $define_email) {
			if ($data->is_active == 1) {
				$data = [
					'id_user' => $id_user,
					'nickname' => $nickname,
					'email' => $define_email,
					'role' => $role,
				];
				// var_dump($data);
				$this->session->set_userdata($data);
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show"
				role="alert">
				<span class="alert-text">
				Anda dapat upload ulang instrumen Anda dengan watermark kami di versi demo Anda! </span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>'
				);
				redirect('bm/channel/uploadcontent');
			}
		}
	}
}
