<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-7ucpQjREER3p1lX8WEpFZxlN', 'production' => false);
		$this->load->model('mdl_cs', 'user');
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');

		$this->load->model('mdl_cs', 'user');
	}

	public function index()
	{
		$this->load->view('transaction');
	}


	public function status()
	{
		// echo 'test get status </br>';
		// print_r($this->veritrans->status($order_id));
		$order_id = $this->input->post('order_id');
		$id_user = $this->session->userdata('id_user');


		$response = $this->veritrans->status($order_id);

		// echo '<pre>';
		// var_dump($response);
		// echo '</pre>';
		// die;
		$amount = $response->gross_amount;
		$k = $response->status_code;
		$order = $response->settlement_time;
		if ($k == "201") {
			$active_alert = '<div class="alert alert-warning alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Lets Pay Your Bills!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/transaction');
		} elseif ($k == "200") {
			$data1 = [
				'status_code' => $k
			];

			$this->user->updateTransaction($order_id, $data1, 'transaction');



			$email = $this->session->userdata('email');

			$this->_sendFile($email, $order_id, $order, $amount, 'success');

			$active_alert = '<div class="alert alert-success alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Success Pay The Bills</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/transaction');
		} else {


			$data1 = [
				'status_code' => $k
			];


			$this->user->updateTransaction($order_id, $data1, 'transaction');
			$id_cs = $this->session->userdata('id_cs');

			$this->user->deleteHistory($id_cs);
			$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Your payment deadline has expired, go to your cart again and pay before it expires</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/transaction');
		}
	}

	public function _sendFile($email, $order_id, $order, $amount, $type)
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
		#$this->email->set_header('Content-type', 'text/html');
		$id_cs = $this->session->userdata('id_cs');

		$c = $this->user->getFile($id_cs, $order_id);
		$profile = $this->user->getByProfile($id_cs);

		$data['c'] = $c;
		// echo '<pre>';
		// $nickname = ;
		// var_dump($nickname);
		// echo '</pre>';


		$data['a'] = [
			'year' => date('Y'),
			'amount' => $amount,
			'order_id' => $order_id,
			'order_date' => $order,
			'nickname' => $profile['first_name'] . ' ' . $profile['last_name'],
			'email' => $this->session->userdata('email')
		];

		$registMessage = $this->load->view('email-sent/invoice', $data, TRUE);
		#$registMessage = "dhjsalkdas";
		// $s = $order_id;

		#$attched_file = $_SERVER["DOCUMENT_ROOT"] . '/files/full/' . $keys;
		$subject = $order_id;
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'success') {
			$this->email->subject('INVOICE-' . $subject);
			$this->email->message($registMessage);
			foreach ($c as $key) {
				$this->email->attach('http://localhost/testing/files/full/' . $key['full_version']);
			}

			$data3 = [
				'status' => 1
			];

			$this->user->updateOrderHistory($id_cs, $data3, 'order_history');

			$data1 = [
				'button_handle' => 1
			];


			$this->user->updateTransaction($order_id, $data1, 'transaction');

			$this->user->deleteCartByIdUser($id_cs);
			foreach ($c as $key) {
				$this->db->set('sales', $key['sales'] + 1);
				$this->db->where('id_product', $key['id_product']);

				$this->db->update('product');
			}
		}



		$this->load->library('email', $config);
		$this->email->send();
		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
	role="alert">
	<span class="alert-text">
	Now check your email</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$this->session->set_flashdata('message', $active_alert);
		redirect('cs/dashboard/transaction');
		#$this->email->send();
		// if ($this->email->send()) {
		// } else {
		// 	$this->email->print_debugger();
		// 	die;
		// }

		// if(){

		// }
	}
}
