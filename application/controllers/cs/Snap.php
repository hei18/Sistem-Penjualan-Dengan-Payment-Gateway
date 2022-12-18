<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:GET, OPTIONS");
class Snap extends CI_Controller
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
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('mdl_cs', 'user');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$id_cs = $this->session->userdata('id_cs');
		$c = $this->user->getCart($id_cs);
		$grossamount		= $this->input->get('amount');

		// Required
		$transaction_details = array(
			'order_id' => getAutoNumber('transaction', 'order_id', 'CsOrder-', 13),
			'gross_amount' => $grossamount, // no decimal allowed for creditcard
		);

		$items = array();
		foreach ($c as $x) {
			$items[] = [
				'id' => $x['id_product'],
				'price' => $x['selling_price'],
				'quantity' => $x['qty'],
				'name' => $x['title']
			];
		}

		// Optional
		#$item_details = array($item1_details, $item2_details);

		$user = $this->user->getCartSingle($id_cs);



		$customer_details = array(
			'first_name'    => $user['first_name'],
			'last_name'     => $user['last_name'],
			'email'         => $user['email'],
			'phone'         => $user['phone_number'],

		);


		// // Optional
		// $customer_details = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'email'         => "andri@litani.com",
		// 	'phone'         => "081122334455",
		// 	'billing_address'  => $billing_address,
		// 	'shipping_address' => $shipping_address
		// );

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'day',
			'duration'  => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $items,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}
	public function finish()
	{
		$result = json_decode($this->input->post('result_data'));
		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>';
		// die;

		if ($result->payment_type == 'bank_transfer') {
			if ($result->va_numbers) {
				foreach ($result->va_numbers as $row) {
					$bank = $row->bank;
					$vaNumber = $row->va_number;
					$billerCode = '';
				}
			} else {
				$bank = 'permata';
				$vaNumber = $result->permata_va_number;
				$billerCode = '';
			}
		} elseif ($result->payment_type == 'echannel') {
			$bank = 'mandiri';
			$vaNumber = $result->bill_key;
			$billerCode = $result->biller_code;
		} else {
			$bank = 'alfamart/indomaret';
			$vaNumber = $result->payment_code;
			$billerCode = '';
		}
		$grossAmount = str_replace('.00', '', $result->gross_amount);
		$id_cs = $this->session->userdata('id_cs');
		$c = $this->user->getCart($id_cs);
		$check = array();
		// if
		foreach ($c as $x) {
			$check[] = [
				'id_cs' => $id_cs,
				'id_product' => $x['id_product'],
				'order_id' => $result->order_id,
				'full_version' => $x['full_version'],
				'status' => 0,
			];
		}
		$this->db->insert_batch('order_history', $check);

		$key = $result->transaction_id;
		$data = [
			'order_id' => $result->order_id,
			'id_cs'	=> $id_cs,
			'gross_amount' => $grossAmount,
			'payment_type' => $result->payment_type,
			'transaction_time' => $result->transaction_time,
			'transaction_status' => $result->transaction_status,
			'pdf_url' => $result->pdf_url,
			'status_code' => $result->status_code,
			'bank' => $bank,
			'va_number' => $vaNumber,
			// 'bill_key' => $bill_key,
			'biller_code' => $billerCode,
			'transaction_id' => $key,
			'button_handle' => 0
		];



		$this->db->insert('transaction', $data);
		$email = $this->session->userdata('email');
		$this->_EmailValidate($email, $key, 'validate');
		// $active_alert = '<div class="alert alert-warning alert-dismissible fade show"
		// 	role="alert">
		// 	<span class="alert-text">
		// 	Check your email for instruction!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		// $this->session->set_flashdata('message', $active_alert);
		// redirect('cs/dashboard/transaction');
	}

	private function _EmailValidate($email, $key, $type)
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
		$undefine = $key;
		$user = $this->user->getTransactionValidate($id_cs, $undefine);
		$define = [
			'full_name' => $user['first_name'] . ' ' . $user['last_name'],
			'url' => $user['pdf_url'],
			'order_id' => $user['order_id']
		];

		$message = $this->load->view('email-sent/instruction', $define, TRUE);
		// var_dump($user);
		// die;
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'validate') {
			$this->email->subject('PAYMENT INSTRUCTION - ' . time());
			$this->email->message($message);
		}
		$this->load->library('email', $config);
		$this->email->send();
		$active_alert = '<div class="alert alert-warning alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Check your email for instruction!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$this->session->set_flashdata('message', $active_alert);
		redirect('cs/dashboard/transaction');
	}
}
