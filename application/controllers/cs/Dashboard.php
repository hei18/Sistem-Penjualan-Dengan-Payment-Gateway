<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		as_cs();

		$this->load->model('mdl_cs', 'cs');
		$this->load->library('pdf');
		$this->load->library('encryption');
	}
	public function index()
	{
		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Dashboard";
		$fetch['user'] = $this->cs->getByIdCs($id_cs);
		$fetch['prod'] = $this->cs->getAllCount();
		$fetch['bm'] = $this->cs->getAllbm();
		$fetch['beat'] = $this->cs->getOneProduct();
		// echo '<pre>';
		// var_dump($fetch['beat']);
		// echo '</pre>';
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side');
		$this->load->view('cs/dashboard', $fetch);
		$this->load->view('layout/adm-footer');
	}

	public function add()
	{
		$id_cs = $this->session->userdata('id_cs');
		$id_product = $this->input->post('id_product');
		$selling_price = $this->input->post('selling_price');
		$title = $this->input->post('title');
		$qty = $this->cs->getCartId($id_cs, $id_product);
		#$qty = $this->db->get_where('cart', []);


		// var_dump($qty['id_cart']);
		// die;
		if ($qty == 0) {
			$sumQty = $qty['qty'] + 1;

			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => getAutoNumber('cart', 'id_cart', 'INV', 8),
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=> $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->db->insert('cart', $data);
		} elseif ($qty['id_cart'] != 0) {

			$sumQty = $qty['qty'] + 1;
			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => $qty['id_cart'],
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=>  $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->cs->updateCart($id_cs, $qty['id_cart'], $data, 'cart');
		}


		#$this->cart->insert($data);
		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
		role="alert">
		<span class="alert-text">
		Berhasil Menambahkan Ke Keranjang</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$this->session->set_flashdata('message', $active_alert);
		redirect('publics/instrumental');
	}

	// public function add()
	// {

	// 	$id_cs = $this->session->userdata('id_cs');
	// 	$id_product = $this->input->post('id_product');
	// 	$selling_price = $this->input->post('selling_price');
	// 	$title = $this->input->post('title');
	// 	$qty = $this->cs->getCartId($id_cs, $id_product);
	// 	#$qty = $this->db->get_where('cart',[])



	// 	if ($qty == 0) {
	// 		$sumQty = $qty['qty'] + 1;

	// 		// var_dump($sumQty);
	// 		// die;
	// 		$subtotal = $sumQty * $selling_price;
	// 		$data = [

	// 			'id_cs' => $id_cs,
	// 			'id_product' => $id_product,
	// 			'title'	=> $title,
	// 			'qty'	=> $sumQty,
	// 			'bill_price' => $selling_price,
	// 			// 'subtotal' => $subtotal,
	// 			// 'mode' => 201,
	// 		];
	// 		$this->db->insert('cart', $data);
	// 		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
	// 		role="alert">
	// 		<span class="alert-text">
	// 		Sukses menambahkan ke cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 		$this->session->set_flashdata('message', $active_alert);
	// 		redirect('publics/instrumental');
	// 	} elseif ($qty['id_cart'] != null) {
	// 		$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
	// 		role="alert">
	// 		<span class="alert-text">
	// 		Hanya dapat 1 kali per instrumental</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 		$this->session->set_flashdata('message', $active_alert);
	// 		redirect('publics/instrumental');
	// 	}
	// }
	public function addHome()
	{

		$id_cs = $this->session->userdata('id_cs');
		$id_product = $this->input->post('id_product');
		$selling_price = $this->input->post('selling_price');
		$title = $this->input->post('title');
		$qty = $this->cs->getCartId($id_cs, $id_product);
		#$qty = $this->db->get_where('cart', []);


		// var_dump($qty['id_cart']);
		// die;
		if ($qty == 0) {
			$sumQty = $qty['qty'] + 1;

			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => getAutoNumber('cart', 'id_cart', 'INV', 8),
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=> $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->db->insert('cart', $data);
		} elseif ($qty['id_cart'] != 0) {

			$sumQty = $qty['qty'] + 1;
			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => $qty['id_cart'],
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=>  $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->cs->updateCart($id_cs, $qty['id_cart'], $data, 'cart');
		}
		$this->session->set_flashdata('onecart', 'Sukses menambahkan ke cart');
		redirect('publics');
	}
	// public function addHome()
	// {

	// 	$id_cs = $this->session->userdata('id_cs');
	// 	$id_product = $this->input->post('id_product');
	// 	$selling_price = $this->input->post('selling_price');
	// 	$title = $this->input->post('title');
	// 	$qty = $this->cs->getCartId($id_cs, $id_product);
	// 	#$qty = $this->db->get_where('cart',[])


	// 	if ($qty == 0) {
	// 		$sumQty = $qty['qty'] + 1;

	// 		// var_dump($sumQty);
	// 		// die;
	// 		$subtotal = $sumQty * $selling_price;
	// 		$data = [

	// 			'id_cs' => $id_cs,
	// 			'id_product' => $id_product,
	// 			'title'	=> $title,
	// 			'qty'	=> $sumQty,
	// 			'bill_price' => $selling_price,
	// 			// 'subtotal' => $subtotal,
	// 			// 'mode' => 201,
	// 		];
	// 		$this->db->insert('cart', $data);
	// 		// $active_alert = '<div class="alert alert-success alert-dismissible fade show"
	// 		// role="alert">
	// 		// <span class="alert-text">
	// 		// Success add to cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 	} elseif ($qty['id_cart'] != null) {

	// 		$this->session->set_flashdata('error', 'Hanya dapat 1 kali per instrument!');
	// 		redirect('publics');
	// 		$this->session->set_flashdata('onecart', 'Sukses menambahkan ke cart');
	// 		redirect('publics');
	// 	}
	// }
	public function addNew()
	{
		$id_cs = $this->session->userdata('id_cs');
		$id_product = $this->input->post('id_product');
		$selling_price = $this->input->post('selling_price');
		$title = $this->input->post('title');
		$qty = $this->cs->getCartId($id_cs, $id_product);
		#$qty = $this->db->get_where('cart', []);


		// var_dump($qty['id_cart']);
		// die;
		if ($qty == 0) {
			$sumQty = $qty['qty'] + 1;

			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => getAutoNumber('cart', 'id_cart', 'INV', 8),
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=> $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->db->insert('cart', $data);
		} elseif ($qty['id_cart'] != 0) {

			$sumQty = $qty['qty'] + 1;
			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [
				'id_cart' => $qty['id_cart'],
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=>  $title,
				'qty'	=> $sumQty,
				'bill_price' => $selling_price,
				'subtotal' => $subtotal
			];
			$this->cs->updateCart($id_cs, $qty['id_cart'], $data, 'cart');
		}
		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
		role="alert">
		<span class="alert-text">
		Sukses menambahkan ke cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		$this->session->set_flashdata('message', $active_alert);
		redirect('cs/dashboard/cart');
	}
	// public function addNew()
	// {
	// 	$id_cs = $this->session->userdata('id_cs');
	// 	$id_product = $this->input->post('id_product');
	// 	$selling_price = $this->input->post('selling_price');
	// 	$title = $this->input->post('title');
	// 	$qty = $this->cs->getCartId($id_cs, $id_product);
	// 	#$qty = $this->db->get_where('cart',[])


	// 	if ($qty == 0) {
	// 		$sumQty = $qty['qty'] + 1;

	// 		// var_dump($sumQty);
	// 		// die;
	// 		$subtotal = $sumQty * $selling_price;
	// 		$data = [

	// 			'id_cs' => $id_cs,
	// 			'id_product' => $id_product,
	// 			'title'	=> $title,
	// 			'qty'	=> $sumQty,
	// 			'bill_price' => $selling_price,
	// 			// 'subtotal' => $subtotal,
	// 			// 'mode' => 201,
	// 		];
	// 		$this->db->insert('cart', $data);
	// 		$active_alert = '<div class="alert alert-success alert-dismissible fade show"
	// 		role="alert">
	// 		<span class="alert-text">
	// 		Sukses menambahkan ke cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 		$this->session->set_flashdata('message', $active_alert);
	// 		redirect('cs/dashboard/cart');
	// 	} elseif ($qty['id_cart'] != null) {
	// 		$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
	// 		role="alert">
	// 		<span class="alert-text">
	// 		Hanya dapat 1 kali per instrument!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 		$this->session->set_flashdata('message', $active_alert);
	// 		redirect('cs/dashboard');
	// 	}
	// }
	public function cart()
	{
		$id_cs = $this->session->userdata('id_cs');
		$param = $this->cs->getProfile($id_cs);

		if ($param == NULL) {
			$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Lengkapi data anda</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/profile');
		} else {
			$fetch['header'] = "BeatAudio Studio";
			$fetch['tittle'] = "Keranjang";
			$fetch['user'] = $this->cs->getByIdCs($id_cs);
			$fetch['prod'] = $this->cs->getAllCount();
			$fetch['bm'] = $this->cs->getAllbm();
			$fetch['cart'] = $this->cs->getCart($id_cs);
			// var_dump($fetch['cart']);
			// die;
			$fetch['count'] = $this->cs->countAllCart($id_cs);
			$fetch['sum'] = $this->cs->sumSubtotal($id_cs);
			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side');
			$this->load->view('cs/cart', $fetch);
			$this->load->view('layout/adm-footer');
		}
	}

	public function profile()
	{
		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio";
		$fetch['user'] = $this->cs->getByIdCs($id_cs);
		$fetch['users'] = $this->cs->getByProfile($id_cs);
		// var_dump($fetch['users']);
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/profile', $fetch);
		$this->load->view('layout/adm-footer');
	}

	public function updateprofile()
	{
		if ($this->input->post('nickname') != 'BeatAudio User') {
			$this->form_validation->set_rules(
				'nickname',
				'Nickname',
				'required'
			);
		} else {
			$this->form_validation->set_rules(
				'nickname',
				'Nickname',
				'required|trim|is_unique[customer.nickname]',
				array(
					'required'      => 'You have not provided %s.',
					'is_unique'     => '%s sudah ada, silahkan ganti'
				)
			);
		}
		$this->form_validation->set_rules(
			'email',
			'Beat Maker Name',
			'required|trim|valid_email|callback_email_check'
		);
		$this->form_validation->set_rules(
			'first_name',
			'First Name',
			'required|trim|regex_match[/^([a-z ])+$/i]',
			[
				'required' => 'Tidak Boleh Kosong'
			]
		);
		$this->form_validation->set_rules(
			'last_name',
			'Last Name',
			'required|trim|regex_match[/^([a-z ])+$/i]',
			[
				'required' => 'Tidak Boleh Kosong'
			]
		);
		$this->form_validation->set_rules(
			'phone_number',
			'Phone Number',
			'required|trim|numeric|min_length[10]|max_length[13]',
			[
				'required' => 'Tidak Boleh Kosong'
			]
		);
		$this->form_validation->set_rules(
			'address',
			'Address',
			'required',
			[
				'required' => 'Tidak Boleh Kosong'
			]
		);


		if ($this->form_validation->run() == false) {
			$id_cs = $this->session->userdata('id_cs');
			$fetch['tittle'] = "Update Profile";
			$fetch['header'] = "BeatAudio";
			$fetch['user'] = $this->cs->getByIdCs($id_cs);
			$fetch['users'] = $this->cs->getByProfile($id_cs);
			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side',);
			$this->load->view('cs/update-profile');
			$this->load->view('layout/adm-footer');
			# code...
		} else {
			$this->_updateProfile();
		}
	}
	private function _updateProfile()
	{
		$callBackImage = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$id_cs = $this->session->userdata('id_cs');
		$nickname = $this->input->post('nickname');
		$email = $this->input->post('email');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$phone_number = $this->input->post('phone_number');
		$address = $this->input->post('address');
		#$photo_profiles = $this->input->post('photo_profiles');

		$upload_image = $_FILES['image']['name'];

		if ($upload_image) {


			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = '20048';
			$config['upload_path'] = './files/pp/';
			// $config['width'] = 600;
			// $config['height'] = 400;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$image = $this->upload->data();
				$upload_file = $image['file_name'];
				$this->resizeImage($upload_file);

				$old_image = $callBackImage['image'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . './files/pp/' . $old_image);
					unlink(FCPATH . './files/new-image/' . $old_image);
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show"
		                                        role="alert">
		                                        <span class="alert-text">
		                                        Opps, yang anda upload bukan gambar</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
				);
				redirect('cs/dashboard/updateprofile');
			}
			$data = [
				'nickname' => $nickname,
				'image' => $image['file_name'],
				'email' => $email,
			];
			$data2 = [
				'id_user' => null,
				'id_cs' => $id_cs,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone_number' => $phone_number,
				'address' => $address,

			];
		} elseif ($upload_image == "") {
			$data = [
				'nickname' => $nickname,
				'email' => $email,
			];
			$data2 = [
				'id_user' => null,
				'id_cs' => $id_cs,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone_number' => $phone_number,
				'address' => $address,

			];
		}


		$query = $this->cs->getByProfile($id_cs);
		if ($query['id_profiles'] != NULL) {

			$this->cs->update_user($id_cs, $data, 'customer');
			$this->cs->updateUserProfile($id_cs, $data2, 'profiles');
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
			                        role="alert">
			                        <span class="alert-text">
			                        Sukses update data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('cs/dashboard/profile');
		} elseif ($query['id_profiles'] == NULL) {

			$this->cs->update_user($id_cs, $data, 'customer');
			$this->db->insert('profiles', $data2);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
			                        role="alert">
			                        <span class="alert-text">
			                        Sukses update data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);

			redirect('cs/dashboard/profile');
		}
	}

	function email_check()
	{
		$id_cs = $this->session->userdata('id_cs');
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM customer WHERE email='$post[email]' And id_cs != $id_cs");

		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('email_check', 'This email has been registered');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function resizeImage($filename)
	{
		$source_path = FCPATH . '/files/pp/' . $filename;
		$target_path = FCPATH . '/files/new-image';
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			#'maintain_ratio' => TRUE,
			#'create_thumb' => TRUE,
			#'thumb_marker' => '_thumb',
			'width' => 360,
			'height' => 360,
			'master_dim' => 'width',
		);


		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}


		$this->image_lib->clear();
	}

	public function transaction()
	{
		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio";
		$fetch['tittle'] = "Transaksi";
		$fetch['user'] = $this->cs->getByIdCs($id_cs);
		$fetch['users'] = $this->cs->getByProfile($id_cs);
		$fetch['bill'] = $this->cs->getTransaction($id_cs);
		#$fetch['item'] = $this->item->getHistory($id_cs);
		// echo '<pre>';
		// var_dump($fetch['item']);

		// echo '</pre>';
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/transaction', $fetch);
		$this->load->view('layout/adm-footer');
	}



	public function expenses()
	{
		$this->form_validation->set_rules('from', 'From Date', 'required|trim');
		$this->form_validation->set_rules('until', 'From Date', 'required|trim');
		if ($this->form_validation->run() == false) {
			$id_cs = $this->session->userdata('id_cs');
			$fetch['header'] = "BeatAudio";
			$fetch['tittle'] = "Pengeluaran";
			// $fetch['user'] = $this->cs->getByIdCs($id_cs);
			$fetch['users'] = $this->cs->getByProfile($id_cs);
			#$fetch['bill'] = $this->cs->getExpenses($id_cs);
			// echo '<pre>';
			// var_dump($fetch['bill']);
			// echo '</pre>';
			// die;

			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side',);
			$this->load->view('cs/expenses', $fetch);
			$this->load->view('layout/adm-footer');
		} else {
			$this->_expansesReport();
		}

		// $from = @$this->input->post('from');
		// $until = @$this->input->post('until');
		// if ($from && $until) {
		// 	$expenses = $this->cs->getExpenses($id_cs, $from, $until);
		// 	var_dump($expenses);
		// 	die;
		// }
	}

	public function _expansesReport()
	{
		$id_cs = $this->session->userdata('id_cs');
		$from = @$this->input->post('from');
		$until = @$this->input->post('until');
		$expenses = $this->cs->getExpenses($id_cs, $from, $until);

		$sum = $this->cs->getSumExpenses($id_cs, $from, $until);
		$this->session->set_flashdata('expenses', $expenses);
		$this->session->set_flashdata('sum', $sum);
		$this->session->set_flashdata('from', $from);
		$this->session->set_flashdata('until', $until);
		redirect('cs/dashboard/expenses');
	}

	public function printExpenses($id_cs, $from, $until)
	{
		$id_cs = $this->session->userdata('id_cs');
		$reportWd['expenses'] = $this->cs->getExpenses($id_cs, $from, $until);
		$reportWd['sum'] = $this->cs->getSumExpenses($id_cs, $from, $until);

		// echo '<pre>';
		// var_dump($reportWd);
		// echo '</pre>';

		$this->load->view('email-sent/printExpenses', $reportWd);
	}

	public function item()
	{
		$get_OrderID = $this->input->get('q');
		$define_orderID = base64_decode($get_OrderID);



		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio";
		$fetch['tittle'] = "Detail Item";
		$fetch['user'] = $this->cs->getByIdCs($id_cs);
		$fetch['users'] = $this->cs->getByProfile($id_cs);
		$fetch['bill'] = $this->cs->getTransaction($id_cs);
		$fetch['item'] = $this->cs->getHistory($id_cs, $define_orderID);
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/list', $fetch);
		$this->load->view('layout/adm-footer');
	}
	public function updateCart()
	{

		$id_cart = $this->input->post('id_cart');
		$id_cs = $this->session->userdata('id_cs');
		// $id_product = $this->input->post('id_product');
		// $title = $this->input->post('title');
		$qty = $this->input->post('qty');
		$bill_price = $this->input->post('bill_price');
		$sum = $qty * $bill_price;
		$data = [
			'id_cart' => $id_cart,
			'id_cs' => $id_cs,
			// 'id_product' => $id_product,
			// 'title' => $title,
			'qty' => $qty,
			'bill_price' => $bill_price,
			'subtotal' => $sum,
		];
		// echo '<pre>';
		// var_dump($data);
		// echo '</pre>';

		$this->cs->updateCart($id_cs, $id_cart, $data);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show"
										role="alert">
										<span class="alert-text">
										Berhasil</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		);
		redirect('cs/dashboard/cart');
		// if ($this->input->post('submit')) {

		// } elseif ($this->input->post('delete')) {
		// }
	}

	public function deleted($id_cart)
	{
		$this->cs->deleteCart($id_cart);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show"
										role="alert">
										<span class="alert-text">
										Sukses hapus data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		);
		redirect('cs/dashboard/cart');
	}

	public function setting()
	{
		if ($this->input->post('change')) {
			$this->form_validation->set_rules(
				'old_pass',
				'Old Password',
				'required',
				[
					'required' => 'Tidak Boleh Kosong'
				]

			);
			$this->form_validation->set_rules(
				'n_pass1',
				'Password',
				'required|trim|matches[n_pass2]',
				[
					'required' => 'Tidak Boleh Kosong',
					'matches' => 'Tidak sama',
				]

			);
			$this->form_validation->set_rules(
				'n_pass2',
				'Password',
				'required|trim|matches[n_pass1]',
				[
					'required' => 'Tidak Boleh Kosong',
					'matches' => 'Tidak sama',
				]

			);
		} elseif ($this->input->post('delete')) {
			$this->form_validation->set_rules(
				'request_delete',
				'Request Delete',
				'required',

			);
		}

		if ($this->form_validation->run() == false) {
			$id_cs = $this->session->userdata('id_cs');
			$fetch['header'] = "BeatAudio Studio";
			$fetch['tittle'] = "Pengaturan";
			$fetch['user'] = $this->cs->getByIdCs($id_cs);
			$fetch['prod'] = $this->cs->getAllCount();
			$fetch['bm'] = $this->cs->getAllbm();

			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side',);
			$this->load->view('cs/account-setting', $fetch);
			$this->load->view('layout/adm-footer');
		} else {
			if ($this->input->post('change')) {
				$current_password = $this->input->post('old_pass');
				$new_password1 = $this->input->post('n_pass1');
				$new_password2 = $this->input->post('n_pass2');

				$change = $this->cs->getByIdCs($this->session->userdata('id_cs'));

				if (password_verify($current_password, $change['password'])) {
					// echo $current_password;
					if ($new_password1 == $new_password2) {

						$data = [
							'password' => password_hash($new_password1, PASSWORD_DEFAULT)
						];

						// var_dump($data);
						// die();
						$this->cs->updatePassword($this->session->userdata('id_cs'), $data);
						$this->session->set_flashdata(
							'message',
							'<div class="alert alert-success alert-dismissible fade show"
					role="alert">
					<span class="alert-text">
					Berhasil</span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button></div>'
						);
						redirect('cs/dashboard/setting');
					}
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Password lama salah</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
					);
					redirect('cs/dashboard/setting');
				}
			} elseif ($this->input->post('delete')) {
				$req = $this->input->post('request_delete');
				if ($req != "DELETED") {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Permintaah Salah</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
					);
					redirect('cs/dashboard/setting');
				} elseif ($req == "DELETED") {
					$id_cs = $this->session->userdata('id_cs');
					$cart = $cart = $this->cs->getValidateCart($id_cs);;
					if (!empty($cart)) {
						$this->session->set_flashdata(
							'message',
							'<div class="alert alert-danger alert-dismissible fade show"
					role="alert">
					<span class="alert-text">
					Permintaan ditolak, anda masih memiliki item di keranjang</span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button></div>'
						);
						redirect('cs/dashboard/setting');
					} else {
						$trans = $this->cs->getTransactionView($id_cs);
						#var_dump($trans);
						if ($trans != []) {
							$this->session->set_flashdata(
								'message',
								'<div class="alert alert-danger alert-dismissible fade show"
						role="alert">
						<span class="alert-text">
						Permintaan ditolak, anda masih belum menyelesaikan pembayaran</span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>'
							);
							redirect('cs/dashboard/setting');
						} elseif ($trans == []) {
							$email = $this->session->userdata('email');
							$this->_SendEmailToDelete($email, $req, 'delete');
						}
					}
				}
			}
		}
	}
	/**
	 * Request Delete Data
	 */
	private function _SendEmailToDelete($email, $req, $type)
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

		$param = $this->cs->getFileName($id_cs);
		$params['empty'] = $this->cs->getFileName($id_cs);
		$params['bm'] = $this->cs->getProfileRequest($id_cs);
		$params['tr'] = $this->cs->getTransaction($id_cs);
		$params['order'] = $this->cs->getHistoryToDelete($id_cs);
		$params['total'] = $this->cs->sumSubtotalHIstory($id_cs);

		$this->load->view('email-sent/data-cs-print', $params);
		$filename = $param['email'] . '-personal-data.pdf';
		// if ($params['bm']['nickname'] != NULL) {
		// } else {
		// 	$filename = time() . '-personal-data.pdf';
		// }




		$ciphertext = base64_encode($id_cs);
		$data['bm'] = [
			'uid' => $ciphertext,
			'pdf' => $filename,
			'full_name' => 'BeatAudio User',
		];

		$message = $this->load->view('email-sent/request-delete-cs', $data, TRUE);
		$this->email->from('beataudio1812@gmail.com', 'Beat Audio');
		$this->email->to($email);
		if ($type == 'delete') {
			$this->email->subject('PERMINTAN PENGHAPUSAN - ' . time());
			$this->email->message($message);
			$data2 = [
				'is_active' => 0,
				'request_delete' => $req,
				'personal_pdf' => $filename
			];
			$this->cs->update_user($this->session->userdata('id_cs'), $data2);
		}
		$this->load->library('email', $config);
		$this->email->send();

		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('id_cs');
		$this->session->unset_userdata('nickname');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan sedang di proses, silahkan check email anda</div>');
		redirect('auth');
	}
	public function d()
	{
		$id_history = $this->input->get('id');
		$file_token = $this->input->get('token');
		// var_dump($file_token);
		// die;
		$file = $this->input->get('file');
		$param = $this->db->get_where(
			'order_history',
			[
				'id_history' => $id_history,

			]
		)->row();

		// var_dump($param);

		// die;
		// if ($id_history == $param->id_history && $file_token == $param->file_token) {
		// 	echo 'berhasil';
		// }

		if ($param->id_history == $id_history && $param->file_token == $file_token) {
			$data = [
				'file_token' => null,
			];
			$this->cs->updateByIdOrder($id_history, $data);
			if ($file == $param->full_version) {
				force_download('files/full/' . $file, NULL);
			}
			echo 'berhasil';
		} elseif ($param->id_history == $id_history && $param->file_token == NULL) {
			$this->load->view('not-found');
		}
	}

	public function check()
	{
		$id_cs = $this->session->userdata('id_cs');
		$param = $this->cs->getFileName($id_cs);
		$params['empty'] = $this->cs->getFileName($id_cs);
		$params['bm'] = $this->cs->getProfileRequest($id_cs);
		$params['tr'] = $this->cs->getTransaction($id_cs);
		$params['order'] = $this->cs->getHistoryToDelete($id_cs);
		$params['total'] = $this->cs->sumSubtotalHIstory($id_cs);

		$this->load->view('email-sent/data-cs-print', $params);
	}
}
