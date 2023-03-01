<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('pdf');
		$this->load->model('mdl_cs', 'user');
		$this->load->library('encryption');
	}

	public function index()
	{
		$this->load->view('transaction');
	}


	public function status()
	{
		// echo 'test get status </br>';
		// print_r($this->veritrans->status($order_id));
		$id_cs = $this->session->userdata('id_cs');
		$order_id = $this->input->post('order_id');
		$response = $this->user->getTransactionToSend($id_cs, $order_id);


		$define_amount = $response['gross_amount'];
		$define_sattlement = $response['settlement_time'];
		$define_status = $response['transaction_status'];


		// echo '<pre>';
		// var_dump($validate);
		// echo '</pre>';

		if ($response['status_code'] == 200) {
			if ($define_status == "settlement") {
				#echo "hahaha";
				$email = $this->session->userdata('email');

				$this->_sendFile($email, $order_id, $define_sattlement, $define_amount, 'success');
			}
		}
	}

	public function _sendFile($email, $order_id, $define_sattlement, $define_amount, $type)
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
			"smtp_keep_alive"    => TRUE
		];
		$this->email->initialize($config);
		$id_cs = $this->session->userdata('id_cs');
		$profile = $this->user->getByProfile($id_cs);
		$content = $this->user->getFile($id_cs, $order_id);
		$validate = $this->user->getSales($id_cs, $order_id);

		$handle['data'] = $content;
		// var_dump($handler);
		// die;
		#$encode = urlencode($token['token']);
		date_default_timezone_set('Asia/Jakarta');


		$handle['person'] = [
			'year' => date('Y'),
			'amount' => $define_amount,
			'order_id' => $order_id,
			'order_date' => $define_sattlement,
			'nickname' => $profile['first_name'] . ' ' . $profile['last_name'],
			'email' => $this->session->userdata('email')
		];

		$registMessage = $this->load->view('email-sent/invoice', $handle, TRUE);
		#$registMessage = "dhjsalkdas";
		// $s = $order_id;

		#$attched_file = $_SERVER["DOCUMENT_ROOT"] . '/files/full/' . $keys;
		$subject = $order_id;
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'success') {
			$this->email->subject('PEMBAYARAN-' . $subject);
			$this->email->message($registMessage);

			$data3 = [
				'status' => 1
			];

		$this->user->updateOrderHistory($id_cs, $order_id, $data3, 'order_history');
// 			$this->db->set('status', 1);
// 			$this->db->where('id_cs', $id_cs);
// 			$this->db->update('order_history');

			$data1 = [
				'button_handle' => 1
			];


			$this->user->updateTransaction($order_id, $data1, 'transaction');

			$this->user->deleteCartByIdUser($id_cs);
			foreach ($validate as $key) {
				$this->db->set('sales', $key['sales'] + $key['qty']);
				$this->db->where('id_product', $key['id_product']);

				$this->db->update('product');
			}
		}



		$this->load->library('email', $config);
		$this->email->send();
		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
		role="alert">
		<span class="alert-text">
		Silahkan check email anda</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$this->session->set_flashdata('message', $active_alert);
		redirect('cs/dashboard/transaction');
	}

	public function optional()
	{
		$id_cs = $this->session->userdata('id_cs');

		$invoice['bm'] = $this->user->getProfileRequest($id_cs);
		$invoice['tr'] = $this->user->getFile($id_cs, 'CsOrder-0001');
		$invoice['total'] = $this->user->sumBillInvoice($id_cs);
		$this->load->view('email-sent/new-invoice', $invoice);
	}

	public function check()
	{
		$id_cs = $this->session->userdata('id_cs');
		$content = $this->user->getFile($id_cs, 'BA-INV-00006');
		echo '<pre>';
		var_dump($content);
		echo '</pre>';
	}
}
