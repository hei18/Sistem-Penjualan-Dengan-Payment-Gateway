<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		as_cs();

		$this->load->model('mdl_cs', 'user');
		$this->load->model('mdl_cs', 'users');
		$this->load->model('mdl_cs', 'carts');
		$this->load->model('mdl_cs', 'item');
	}
	public function index()
	{
		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio Studio";
		$fetch['tittle'] = "Dashboard";
		$fetch['user'] = $this->user->getByIdCs($id_cs);
		$fetch['prod'] = $this->user->getAllCount();
		$fetch['bm'] = $this->user->getAllbm();
		$fetch['beat'] = $this->user->getOneProduct();
		// echo '<pre>';
		// var_dump($fetch['beat']);
		// echo '</pre>';
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/dashboard', $fetch);
		$this->load->view('layout/adm-footer');
	}

	// public function add()
	// {
	// 	$id_user = $this->session->userdata('id_user');
	// 	$id_product = $this->input->post('id_product');
	// 	$selling_price = $this->input->post('selling_price');
	// 	$title = $this->input->post('title');
	// $qty = $this->user->getCartId($id_user, $id_product);
	// 	#$qty = $this->db->get_where('cart',[])


	// 	// var_dump($qty['id_cart']);
	// 	// die;
	// 	if ($qty == 0) {
	// 		$sumQty = $qty['qty'] + 1;

	// 		// var_dump($sumQty);
	// 		// die;
	// 		$subtotal = $sumQty * $selling_price;
	// 		$data = [
	// 			'id_cart' => getAutoNumber('cart', 'id_cart', 'INV', 8),
	// 			'id_user' => $id_user,
	// 			'id_product' => $id_product,
	// 			'title'	=> $title,
	// 			'qty'	=> $sumQty,
	// 			'selling_price' => $selling_price,
	// 			'subtotal' => $subtotal
	// 		];
	// 		$this->db->insert('cart', $data);
	// 	} elseif ($qty['id_cart'] != 0) {

	// 		$sumQty = $qty['qty'] + 1;
	// 		// var_dump($sumQty);
	// 		// die;
	// 		$subtotal = $sumQty * $selling_price;
	// 		$data = [
	// 			'id_cart' => $qty['id_cart'],
	// 			'id_user' => $id_user,
	// 			'id_product' => $id_product,
	// 			'title'	=>  $title,
	// 			'qty'	=> $sumQty,
	// 			'selling_price' => $selling_price,
	// 			'subtotal' => $subtotal
	// 		];
	// 		$this->user->updateCart($id_user, $qty['id_cart'], $data, 'cart');
	// 	}


	// 	#$this->cart->insert($data);
	// 	$active_alert = '<div class="alert alert-success alert-dismissible fade show"
	// 	role="alert">
	// 	<span class="alert-text">
	// 	Success add to cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	// 	$this->session->set_flashdata('message', $active_alert);
	// 	redirect('publics/instrumental');
	// }

	public function add()
	{

		$id_cs = $this->session->userdata('id_cs');
		$id_product = $this->input->post('id_product');
		$selling_price = $this->input->post('selling_price');
		$title = $this->input->post('title');
		$qty = $this->user->getCartId($id_cs, $id_product);
		#$qty = $this->db->get_where('cart',[])


		if ($qty == 0) {
			$sumQty = $qty['qty'] + 1;

			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [

				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=> $title,
				'qty'	=> $sumQty,
				'selling_price' => $selling_price,
				'subtotal' => $subtotal,
				// 'mode' => 201,
			];
			$this->db->insert('cart', $data);
			$active_alert = '<div class="alert alert-success alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Success add to cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('publics/instrumental');
		} elseif ($qty['id_cart'] != null) {
			$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			You can only add to cart one time per instrumental!!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('publics/instrumental');
		}
	}
	public function addNew()
	{
		$id_cs = $this->session->userdata('id_cs');
		$id_product = $this->input->post('id_product');
		$selling_price = $this->input->post('selling_price');
		$title = $this->input->post('title');
		$qty = $this->user->getCartId($id_cs, $id_product);
		#$qty = $this->db->get_where('cart',[])


		if ($qty == 0) {
			$sumQty = $qty['qty'] + 1;

			// var_dump($sumQty);
			// die;
			$subtotal = $sumQty * $selling_price;
			$data = [

				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title'	=> $title,
				'qty'	=> $sumQty,
				'selling_price' => $selling_price,
				'subtotal' => $subtotal,
				// 'mode' => 201,
			];
			$this->db->insert('cart', $data);
			$active_alert = '<div class="alert alert-success alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Success add to cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/cart');
		} elseif ($qty['id_cart'] != null) {
			$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			You can only add to cart one time per instrumental!!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard');
		}
	}
	public function cart()
	{
		$id_cs = $this->session->userdata('id_cs');
		$param = $this->user->getProfile($id_cs);

		if ($param == NULL) {
			$active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			You must be update your profile first</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$this->session->set_flashdata('message', $active_alert);
			redirect('cs/dashboard/profile');
		} else {
			$fetch['header'] = "BeatAudio Studio";
			$fetch['tittle'] = "Cart";
			$fetch['user'] = $this->user->getByIdCs($id_cs);
			$fetch['prod'] = $this->user->getAllCount();
			$fetch['bm'] = $this->user->getAllbm();
			$fetch['cart'] = $this->carts->getCart($id_cs);
			// var_dump($fetch['cart']);
			// die;
			$fetch['count'] = $this->carts->countAllCart($id_cs);
			$fetch['sum'] = $this->carts->sumSubtotal($id_cs);
			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side',);
			$this->load->view('cs/cart', $fetch);
			$this->load->view('layout/adm-footer');
		}
	}

	public function profile()
	{
		$id_cs = $this->session->userdata('id_cs');
		$fetch['header'] = "BeatAudio";
		$fetch['user'] = $this->user->getByIdCs($id_cs);
		$fetch['users'] = $this->users->getByProfile($id_cs);
		// var_dump($fetch['users']);
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/profile', $fetch);
		$this->load->view('layout/adm-footer');
	}

	public function updateprofile()
	{
		$this->form_validation->set_rules(
			'nickname',
			'Beat Maker Name',
			'required|trim'
		);
		$this->form_validation->set_rules(
			'email',
			'Beat Maker Name',
			'required|trim|valid_email|callback_email_check'
		);
		$this->form_validation->set_rules(
			'first_name',
			'First Name',
			'required|trim|regex_match[/^([a-z ])+$/i]'
		);
		$this->form_validation->set_rules(
			'last_name',
			'Last Name',
			'required|trim|regex_match[/^([a-z ])+$/i]'
		);
		$this->form_validation->set_rules(
			'phone_number',
			'Phone Number',
			'required|trim|numeric|min_length[10]|max_length[13]'
		);
		$this->form_validation->set_rules(
			'address',
			'Address',
			'required'
		);
		// if (empty($_FILES['image']['name'])) {
		//     $this->form_validation->set_rules(
		//         'image',
		//         'Photo Profile',
		//         'required|is_image'
		//     );
		// }

		if ($this->form_validation->run() == false) {
			$id_cs = $this->session->userdata('id_cs');
			$fetch['tittle'] = "Channel Update Profile";
			$fetch['header'] = "BeatAudio";
			$fetch['user'] = $this->user->getByIdCs($id_cs);
			$fetch['users'] = $this->users->getByProfile($id_cs);
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
		                                        Your file upload is not image!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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


		$query = $this->users->getByProfile($id_cs);
		if ($query['id_profiles'] != NULL) {

			$this->user->update_user($id_cs, $data, 'customer');
			$this->user->updateUserProfile($id_cs, $data2, 'profiles');
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
			                        role="alert">
			                        <span class="alert-text">
			                        Your account has been updated</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
			);
			redirect('cs/dashboard/profile');
		} elseif ($query['id_profiles'] == NULL) {

			$this->user->update_user($id_cs, $data, 'customer');
			$this->db->insert('profiles', $data2);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show"
			                        role="alert">
			                        <span class="alert-text">
			                        Your account has been updated</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
		$fetch['tittle'] = "Transaction";
		$fetch['user'] = $this->user->getByIdCs($id_cs);
		$fetch['users'] = $this->users->getByProfile($id_cs);
		$fetch['bill'] = $this->users->getTransaction($id_cs);
		$fetch['item'] = $this->item->getHistory($id_cs);
		// echo '<pre>';
		// var_dump($fetch['item']);

		// echo '</pre>';
		// die;
		$this->load->view('layout/cs-header', $fetch);
		$this->load->view('layout/cs-side',);
		$this->load->view('cs/transaction', $fetch);
		$this->load->view('layout/adm-footer');
	}


	public function updateCart()
	{
		$id_cart = $this->input->post('id_cart');
		$id_cs = $this->input->post('id_cs');
		$id_product = $this->input->post('id_product');
		$title = $this->input->post('title');
		$qty = $this->input->post('qty');
		$selling_price = $this->input->post('selling_price');
		$sum = $qty * $selling_price;
		if ($this->input->post('submit')) {
			$data = [
				'id_cart' => $id_cart,
				'id_cs' => $id_cs,
				'id_product' => $id_product,
				'title' => $title,
				'qty' => $qty,
				'selling_price' => $selling_price,
				'subtotal' => $sum,
			];

			$this->carts->updateCart($id_cs, $id_cart, $data);
			redirect('cs/dashboard/cart');
		} elseif ($this->input->post('delete')) {
		}
	}

	public function deleted($id_cart)
	{
		$this->carts->deleteCart($id_cart);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fade show"
										role="alert">
										<span class="alert-text">
										Success delete data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
			$fetch['tittle'] = "Dashboard";
			$fetch['user'] = $this->user->getByIdCs($id_cs);
			$fetch['prod'] = $this->user->getAllCount();
			$fetch['bm'] = $this->user->getAllbm();

			$this->load->view('layout/cs-header', $fetch);
			$this->load->view('layout/cs-side',);
			$this->load->view('cs/account-setting', $fetch);
			$this->load->view('layout/adm-footer');
		} else {
			if ($this->input->post('change')) {
				$current_password = $this->input->post('old_pass');
				$new_password1 = $this->input->post('n_pass1');
				$new_password2 = $this->input->post('n_pass2');

				$change = $this->user->getByIdCs($this->session->userdata('id_cs'));

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
						redirect('cs/dashboard/setting');
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
                Wrong Request!!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
					);
					redirect('cs/dashboard/setting');
				} elseif ($req == "DELETED") {

					$data2 = [
						'is_active' => 0,
						'request_delete' => $req,
					];
					$this->user->update_user($this->session->userdata('id_cs'), $data2);
					$this->session->unset_userdata('id_user');
					$this->session->unset_userdata('id_cs');
					$this->session->unset_userdata('nickname');
					$this->session->unset_userdata('email');
					$this->session->unset_userdata('role');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Request In Process</div>');
					redirect('auth');
				}
			}
		}
	}
}
