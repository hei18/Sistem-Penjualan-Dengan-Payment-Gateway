<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Handler extends CI_Controller
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
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		$this->load->model('mdl_cs', 'user');
		$this->load->library('encryption');
	}

	public function index($order_id)
	{
		$key1 = $this->input->post($order_id);
		$key2 = $this->input->post('transaction_id');

		var_dump($key1);
		var_dump($key2);

		// if ($key) {
		// 	if ($code == 200) {
		// 		$data = [
		// 			'status_code' => $code
		// 		];
		// 		$this->db->update('transaction', $data, ['order_id' => $order_id]);
		// 	}
		// }
		// if ($result->status_code == 200) {
		// 	if ($handling) {
		// 		$config = [
		// 			'protocol' => 'smtp',
		// 			'smtp_host' => 'ssl://smtp.googlemail.com',
		// 			'smtp_user' => 'beataudio1812@gmail.com',
		// 			'smtp_pass' => 'coihrjfpbftfoqyd',
		// 			'smtp_port' => 465,
		// 			'mailtype' => 'html',
		// 			'charset' => 'utf-8',
		// 			'newline' => "\r\n",
		// 		];
		// 		$this->email->initialize($config);
		// 		$email = $this->session->userdata('email');
		// 		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		// 		$this->email->to('bernardbear1812@gmail.com');
		// 		$this->email->subject('INVOICE-');
		// 		$this->email->message("hai");
		// 		$this->load->library('email', $config);
		// 		$this->email->send();
		// 	}
		// }

		// error_log(print_r($result, TRUE));

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      }
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  }
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  }
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/
	}
	public function d()
	{
		$key1 = $this->input->get('uid');
		$key2 = $this->input->get('key');

		$define_OrderID = base64_decode($key1);
		$define_PaymenType = base64_decode($key2);



		$validate = $this->veritrans->status($define_OrderID);
		// echo '<pre>';
		// var_dump($validate);
		// echo '</pre>';
		// die;
		$define_code = $validate->status_code;




		// echo '<pre>';
		// var_dump($validate->order_id);
		// echo '</pre>';
		if ($define_code == 201) {
			if ($define_PaymenType == $validate->payment_type) {
				$active_alert = '<div class="alert alert-warning alert-dismissible fade show"
						role="alert">
						<span class="alert-text">
						Do your payment !</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				$this->session->set_flashdata('message', $active_alert);
			}
			redirect('cs/dashboard/transaction');
		} elseif ($define_code == 200) {
			if ($define_PaymenType == $validate->payment_type) {
				$data = [
					'status_code' => $define_code,
					'settlement_time' =>  $validate->settlement_time,
					'transaction_status' => $validate->transaction_status
				];
				$this->db->update('transaction', $data, ['order_id' => $define_OrderID]);
				$active_alert = '<div class="alert alert-success alert-dismissible fade show"
								role="alert">
								<span class="alert-text">
								Confirm Sucess, Now click button "Give Me Beat"</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				$this->session->set_flashdata('message', $active_alert);
				redirect('cs/dashboard/transaction');
			}
		} else {
			if ($define_PaymenType == $validate->payment_type) {
				$data = [
					'status_code' => $define_code,
					'settlement_time' =>  $validate->settlement_time,
					'transaction_status' => $validate->transaction_status
				];
				$this->db->update('transaction', $data, ['order_id' => $define_OrderID]);
				$active_alert = '<div class="alert alert-success alert-dismissible fade show"
								role="alert">
								<span class="alert-text">
								Confirm Sucess, Now click button "Give Me Beat"</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				$this->session->set_flashdata('message', $active_alert);
				redirect('cs/dashboard/transaction');
			}
		}
	}
}
