<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		as_admin();

		$this->load->model('mdl_admin', 'user');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Dashboard";
		$fetch['user'] = $this->user->getById($id_user);
		$fetch['prod'] = $this->user->getAllCount();
		$fetch['bm'] = $this->user->getAllbm();
		$fetch['cs'] = $this->user->getAllCs();
		$fetch['wd'] = $this->user->getAllWd();
		$fetch['ppn'] = $this->user->getPPN();
		// var_dump($fetch['ppn']);
		// die;
		$this->load->view('layout/adm-header', $fetch);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/dashboard', $fetch);
		$this->load->view('layout/adm-footer');
	}
	public function bmcontent()
	{
		$id_user = $this->session->userdata('id_user');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Beatmaker Content";
		$fetch['user'] = $this->user->getById($id_user);
		$fetch['prod'] = $this->user->getAllCount();
		$fetch['bm'] = $this->user->getAllbm();
		$fetch['getProd'] = $this->user->getAllProduct();
		$this->load->view('layout/adm-header', $fetch);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/bm-content', $fetch);
		$this->load->view('layout/adm-footer');
	}

	public function update()
	{
		$data = [
			'status_product' => 1
		];

		$this->db->update('product', $data);

		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show"
										role="alert">
										<span class="alert-text">
										Canceled</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		);
		redirect('admin/dashboard/bmcontent');
	}
	public function updateReview($id_product)
	{
		$data = $this->user->getByIdProduct($id_product);
		date_default_timezone_set('Asia/Jakarta');

		$params = [
			'title' => $data['title'],
			'date_release' => $data['date_release'],
			'genre' => $data['genre'],
			'date_canceled' => date('Y-m-d'),
			'year' => date('Y'),
		];
		$prod = $data['id_product'];
		$email = $this->input->post('email');
		if ($data > 0) {
			$this->_SendEmailForReview($email, $prod, $params, 'review');
			#var_dump($prod);
		}
		// $data = [
		// 	'status_product' => 3
		// ];

		// $this->db->update('product', $data);

		// $this->session->set_flashdata(
		// 	'message',
		// 	'<div class="alert alert-success alert-dismissible fade show"
		// 								role="alert">
		// 								<span class="alert-text">
		// 								Success posted</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		// );
		// redirect('admin/dashboard/bmcontent');
	}

	public function _SendEmailForReview($email, $prod, $params, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'beataudio1812@gmail.com',
			'smtp_pass' => 'coihrjfpbftfoqyd',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'newline' => "\r\n",
		];

		$this->email->initialize($config);
		$subject = 'CANCELED ' . time();
		$canceledMessage = $this->load->view('email-sent/report-canceled', $params, TRUE);
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'review') {
			$this->email->subject($subject);
			$this->email->message($canceledMessage);
			$data = [
				'status_product' => 3
			];

			$this->user->updateProduct($prod, $data, 'product');
		}
		$this->load->library('email', $config);

		if ($this->email->send()) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
											role="alert">
											<span class="alert-text">
											Success canceled and email was sent</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('admin/dashboard/bmcontent');
		} else {
			$this->email->print_debugger();
			die;
		}
	}
	public function deleteContent($id_product)
	{
		$data = $this->user->getByIdProduct($id_product);
		date_default_timezone_set('Asia/Jakarta');
		$params = [
			'title' => $data['title'],
			'date_release' => $data['date_release'],
			'genre' => $data['genre'],
			'date_canceled' => date('Y-m-d'),
			'year' => date('Y'),
		];
		$prod = $data['id_product'];
		$email = $this->input->post('email');
		$callBackThumbnail = $data['thumbnail'];
		$callBackFull = $data['full_version'];
		$callBackDemo = $data['demo_version'];
		if ($data > 0) {
			$this->_sendEmailTakeDown($email, $prod, $callBackThumbnail, $callBackFull, $callBackDemo, $params, 'delete');
		}
	}
	private function _sendEmailTakeDown($email, $prod, $callBackThumbnail, $callBackFull, $callBackDemo, $params, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'beataudio1812@gmail.com',
			'smtp_pass' => 'coihrjfpbftfoqyd',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'newline' => "\r\n",
		];

		$this->email->initialize($config);
		$subject = 'TAKEDOWN ' . time();
		$canceledMessage = $this->load->view('email-sent/report-delete', $params, TRUE);
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);

		if ($type == 'delete') {
			$this->email->subject($subject);
			$this->email->message($canceledMessage);

			unlink(FCPATH . './files/thumbnail/' . $callBackThumbnail);
			unlink(FCPATH . './files/master-image/' . $callBackThumbnail);
			unlink(FCPATH . './files/full/' . $callBackFull);
			unlink(FCPATH . './files/demo/' . $callBackDemo);
			$this->user->deleteContentData($prod);
		}

		$this->load->library('email', $config);

		if ($this->email->send()) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
											role="alert">
											<span class="alert-text">
											Success takedown and email was sent</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('admin/dashboard/bmcontent');
		} else {
			$this->email->print_debugger();
			die;
		}
	}
	public function requestWd()
	{
		$this->form_validation->set_rules('net_income', 'net income', 'required');
		$this->form_validation->set_rules('email', 'net income', 'required');
		$this->form_validation->set_rules('date_wd', 'net income', 'required');
		if ($this->form_validation->run() == false) {
			$id_user = $this->session->userdata('id_user');
			$fetch['header'] = "BeatAudio Studio";
			$fetch['tittle'] = "Withdraw";
			$fetch['user'] = $this->user->getById($id_user);
			$fetch['prod'] = $this->user->getAllCount();
			$fetch['bm'] = $this->user->getAllbm();
			$fetch['getProd'] = $this->user->getAllProduct();
			$fetch['wd'] = $this->user->getAllWithdraw();
			$this->load->view('layout/adm-header', $fetch);
			$this->load->view('layout/adm-side',);
			$this->load->view('admin/bm-wd', $fetch);
			$this->load->view('layout/adm-footer');
		} else {
			$net_income = $this->input->post('net_income');
			$date_wd = $this->input->post('date_wd');
			$email = $this->input->post('email');
			$this->_sendEmail($email, $date_wd, $net_income, 'wd');
		}
	}
	private function _sendEmail($email, $date_wd, $net_income, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'beataudio1812@gmail.com',
			'smtp_pass' => 'coihrjfpbftfoqyd',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'newline' => "\r\n",
		];
		$this->email->initialize($config);
		$data = [
			'img' => 'http://localhost/testing/assets/img/core-img/logos.png',
			'now' => date('Y-m-d H:i:s'),
			'year' => date('Y'),
			'wd_id' => time(),
			'net_income' => $net_income,
			'email' => $email,
			'date_wd' => $date_wd
		];
		$subject = 'Withdraw ' . time();
		$registMessage = $this->load->view('email-sent/report-wd', $data, TRUE);

		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'wd') {
			$this->email->subject($subject);
			$this->email->message($registMessage);

			$data3 = [
				'status_income' => 1
			];
			$this->user->updateIncome($email, $data3, 'income');
		}
		$this->load->library('email', $config);

		if ($this->email->send()) {
			redirect('admin/dashboard/requestWd');
		} else {
			$this->email->print_debugger();
			die;
		}
	}

	public function beatmaker()
	{
		$id_user = $this->session->userdata('id_user');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Beatmaker";
		$fetch['user'] = $this->user->getById($id_user);
		$fetch['bm'] = $this->user->getAllUserBeatmaker();
		// echo '<pre>';
		// var_dump($fetch['bm']);

		// echo '</pre>';
		// die;
		$this->load->view('layout/adm-header', $fetch);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/user-beatmaker', $fetch);
		$this->load->view('layout/adm-footer');
	}
	public function detailUserBeatmaker($id_user)
	{
		$fetch['bmdata'] = $this->user->getUserData($id_user);
		$fetch['bank'] = $this->user->getUserBank($id_user);
		// echo '<pre>';
		// var_dump($fetch['bmdata']);

		// echo '</pre>';
		// die;
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Beatmaker";
		$this->load->view('layout/adm-header',);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/user-beatmaker-detail', $fetch);
		$this->load->view('layout/adm-footer');
	}
	public function requestdelete($id_user)
	{
		$data = $this->user->getProductByRequestt($id_user);
		$image = $this->user->getByIdBm($id_user);

		if ($image > 0) {
			if ($image['image'] == "default.jpg") {
				foreach ($data as $key) {
					unlink(FCPATH . './files/thumbnail/' . $key['thumbnail']);
					unlink(FCPATH . './files/master-image/' . $key['thumbnail']);
					unlink(FCPATH . './files/full/' . $key['full_version']);
					unlink(FCPATH . './files/demo/' . $key['demo_version']);
				}
				$this->user->deleteByRequest($id_user);
				$this->user->deleteUserByRequest($id_user);
				redirect('admin/dashboard/beatmaker');
			} elseif ($image['image'] != "default.jpg") {
				foreach ($data as $key) {
					unlink(FCPATH . './files/thumbnail/' . $key['thumbnail']);
					unlink(FCPATH . './files/master-image/' . $key['thumbnail']);
					unlink(FCPATH . './files/full/' . $key['full_version']);
					unlink(FCPATH . './files/demo/' . $key['demo_version']);
				}
				unlink(FCPATH . './files/pp/' . $image['image']);
				$this->user->deleteByRequest($id_user);
				$this->user->deleteUserByRequest($id_user);
				redirect('admin/dashboard/beatmaker');
			}
		}
	}
	public function customer()
	{
		$id_user = $this->session->userdata('id_user');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Customer";
		$fetch['user'] = $this->user->getById($id_user);
		$fetch['cs'] = $this->user->getAllUserCustomer();
		#$fetch['details'] = $this->user->getCustomerDetail();
		// echo '<pre>';
		// var_dump($fetch['cs']);

		// echo '</pre>';
		// die;
		$this->load->view('layout/adm-header', $fetch);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/user-customer', $fetch);
		$this->load->view('layout/adm-footer');
	}

	public function detailUserCustomer($id_cs)
	{
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Customer ";
		$fetch['bmdata'] = $this->user->getCustomerDetail($id_cs);
		// echo '<pre>';
		// var_dump($fetch['bmdata']);

		// echo '</pre>';
		// die;
		$this->load->view('layout/adm-header', $fetch);
		$this->load->view('layout/adm-side',);
		$this->load->view('admin/user-customer-detail', $fetch);
		$this->load->view('layout/adm-footer');
	}
	public function requestdeleteCs($id_cs)
	{
		$data = $this->user->getByIdCs($id_cs);
		// var_dump($data);
		// die;
		if ($data > 0) {
			if ($data['image'] == "default.jpg") {

				$this->user->deleteCustomerByRequest($id_cs);
			} elseif ($data['image'] != "default.jpg") {
				unlink(FCPATH . './files/pp/' . $data['image']);
				$this->user->deleteCustomerByRequest($id_cs);
			}
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
                                            role="alert">
                                            <span class="alert-text">
                                            Success delete data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('admin/dashboard/customer');
		}
	}

	public function changepassword()
	{

		$this->form_validation->set_rules(
			'old_pass',
			'Old Password',
			'required',

		);
		$this->form_validation->set_rules(
			'n_pass1',
			'Password',
			'required|trim|matches[n_pass2]',

		);
		$this->form_validation->set_rules(
			'n_pass2',
			'Password',
			'required|trim|matches[n_pass1]',

		);
		if ($this->form_validation->run() == false) {
			$id_user = $this->session->userdata('id_user');
			$fetch['header'] = "BeatAudio Studio";
			$fetch['tittle'] = "Change Password";
			$fetch['user'] = $this->user->getById($id_user);

			$this->load->view('layout/adm-header', $fetch);
			$this->load->view('layout/adm-side',);
			$this->load->view('admin/change-password', $fetch);
			$this->load->view('layout/adm-footer');
		} else {
			$this->_resetPassword();
		}
	}

	private function _resetPassword()
	{
		$current_password = $this->input->post('old_pass');
		$new_password1 = $this->input->post('n_pass1');
		$new_password2 = $this->input->post('n_pass2');

		$change = $this->user->getById($this->session->userdata('id_user'));

		if (password_verify($current_password, $change['password'])) {
			if ($new_password1 == $new_password2) {

				$data = [
					'password' => password_hash($new_password1, PASSWORD_DEFAULT)
				];

				// var_dump($data);
				// die();
				$this->user->updatePassword($this->session->userdata('id_user'), $data);
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible fade show"
				role="alert">
				<span class="alert-text">
				You have been change password</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>'
				);
				redirect('admin/dashboard');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			The old password is wrong</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('admin/dashboard/changepassword');
		}
	}
}
