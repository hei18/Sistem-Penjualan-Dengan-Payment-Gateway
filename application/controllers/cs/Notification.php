<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:POST, OPTIONS");
header('Content-Type: application/json');
header('Accept: application/json');

class Notification extends CI_Controller
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
	}

	public function index()
	{
		echo 'test notification handler';
		$define_json = json_decode(file_get_contents("php://input"), TRUE);


		$define_id = $define_json['transaction_id'];
		$define_time = $define_json['transaction_time'];
		$define_status = $define_json['transaction_status'];
		$define_code = $define_json['status_code'];

		$data = [
			'status_code' => $define_code,
			'settlement_time' => $define_time,
			'transaction_status' => $define_status
		];
		if ($define_code == 200) {
			$this->db->update('transaction', $data, ['transaction_id' => $define_id]);
		} elseif ($define_code == 201) {
			$this->db->update('transaction', $data, ['transaction_id' => $define_id]);
		} elseif ($define_code == 202) {
			$this->db->update('transaction', $data, ['transaction_id' => $define_id]);
		}

		// $notif = $this->veritrans->status();
		// 		error_log(print_r('new trans '.$none , TRUE));

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
}
