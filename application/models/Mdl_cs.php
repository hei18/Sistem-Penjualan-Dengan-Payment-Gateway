<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_cs extends CI_Model
{
	public function getByIdCs($id_cs)
	{
		return $this->db->get_where('customer', ['id_cs' => $id_cs])->row_array();
	}


	public function getAllCount()
	{
		$this->db->select('*');
		$this->db->from('product');
		return $this->db->count_all_results();
	}

	public function getAllBm()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('role', 'beatmaker');
		return $this->db->count_all_results();
	}

	public function getAllProduct()
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('user', 'user.id_user = product.id_user');
		$this->db->where('role', 'beatmaker');
		return $this->db->get()->result_array();
	}
	public function getByIdProduct($id_product)
	{
		return $this->db->get_where('product', ['id_product' => $id_product])->row_array();
	}

	public function getCartId($id_cs, $id_product)
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->join('customer', 'cart.id_cs = customer.id_cs');
		$this->db->join('product', 'cart.id_product = product.id_product');
		$this->db->where('customer.id_cs', $id_cs);
		$this->db->where('product.id_product', $id_product);
		return $this->db->get()->row_array();
	}

	public function getCart($id_cs)
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->join('customer', 'customer.id_cs = cart.id_cs ');
		$this->db->join('profiles', 'profiles.id_cs = cart.id_cs',);
		$this->db->join('product', 'product.id_product = cart.id_product ');
		$this->db->where('cart.id_cs =', $id_cs);
		#$this->db->where('cart.id_user =', $id_user);
		return $this->db->get()->result_array();
	}

	public function getCartSingle($id_cs)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('cart', 'cart.id_cs = customer.id_cs',);
		$this->db->join('profiles', 'profiles.id_cs = customer.id_cs',);
		$this->db->where('customer.id_cs =', $id_cs);
		#$this->db->where('cart.id_user =', $id_user);
		return $this->db->get()->row_array();
	}

	public function getAllCart()
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->where('handle', 0);
		#$this->db->where('user.id_user =', $id_user);
		#$this->db->where('cart.id_user =', $id_user);
		return $this->db->get()->result_array();
	}

	public function getProfile($id_cs)
	{
		$this->db->select('*');
		$this->db->from('profiles');
		$this->db->join('customer', 'customer.id_cs = profiles.id_cs',);

		$this->db->where('profiles.id_cs =', $id_cs);

		return $this->db->get()->result_array();
	}
	public function getByProfile($id_cs)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('profiles', 'profiles.id_cs = customer.id_cs', 'left');
		$this->db->where('customer.id_cs =', $id_cs);

		return $this->db->get()->row_array();
	}

	public function getTransaction($id_cs)
	{

		$this->db->select('*');
		$this->db->from('transaction');
		#$this->db->join('cart', 'cart.id_cart = transaction.id_cart');
		#$this->db->join('product', 'product.id_product = transaction.id_product');
		$this->db->join('customer', 'customer.id_cs = transaction.id_cs');
		$this->db->join('profiles', 'profiles.id_cs = customer.id_cs');
		$this->db->where('transaction.id_cs =', $id_cs);
		#$this->db->order_by('order_id');

		return $this->db->get()->result_array();
	}

	public function getHistory($id_cs)
	{
		$this->db->select('*');
		$this->db->from('order_history');
		#$this->db->join('cart', 'cart.id_cart = transaction.id_cart');
		#$this->db->join('product', 'product.id_product = transaction.id_product');
		$this->db->join('customer', 'customer.id_cs = order_history.id_cs');
		$this->db->join('product', 'product.id_product = order_history.Id_product');
		$this->db->where('order_history.id_cs =', $id_cs);
		return $this->db->get()->result_array();
	}
	public function countAllCart($id_cs)
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->join('customer', 'customer.id_cs = cart.id_cs ');
		#$this->db->join('product', 'product.id_cs = cart.id_cs ');
		$this->db->where('cart.id_cs =', $id_cs);
		#$this->db->where('cart.id_product =', $id_product);
		return $this->db->count_all_results();
	}

	public function sumSubtotal($id_cs)
	{
		$this->db->select_sum('subtotal');
		$this->db->from('cart');
		$this->db->where('id_cs', $id_cs);
		return $this->db->get()->row()->subtotal;
	}

	public function getFile($id_cs, $order_id)
	{
		$this->db->select('*');
		$this->db->from('order_history');
		$this->db->join('customer', 'customer.id_cs = order_history.id_cs');
		$this->db->join('product', 'product.id_product = order_history.id_product');
		$this->db->where('order_history.id_cs =', $id_cs);
		$this->db->where('order_history.order_id =', $order_id);
		return $this->db->get()->result_array();
	}
	// public function getFileForUpdate($id_cs)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('order_history');
	// 	$this->db->join('customer', 'customer.id_cs = order_history.id_cs');
	// 	$this->db->where('order_history.id_cs =', $id_cs);
	// 	$this->db->where('order_history.order_id =', $order_id);
	// 	return $this->db->get()->result_array();
	// }
	/**
	 * Delete
	 */
	public function deleteContentData($id_product)
	{
		$this->db->where('id_product', $id_product);
		return $this->db->delete('product');
	}

	public function deleteCart($id_cart)
	{
		$this->db->where('id_cart', $id_cart);
		return $this->db->delete('cart');
	}

	public function deleteCartByIdUser($id_cs)
	{
		$this->db->where('id_cs', $id_cs);
		return $this->db->delete('cart');
	}

	public function deleteHistory($id_cs)
	{
		$this->db->where('id_cs', $id_cs);
		return $this->db->delete('order_history');
	}

	/**
	 * Insert
	 */

	public function insertCart()
	{
		# code...
	}

	/**
	 * Update
	 */
	public function updateCart($id_user, $id_cart, $data)
	{
		$this->db->update('cart', $data, ['id_user' => $id_user, 'id_cart' => $id_cart]);
	}
	public function update_user($id_cs, $data)
	{
		$this->db->update('customer', $data, ['id_cs' => $id_cs]);
	}

	public function updatePassword($id_cs, $data)
	{
		$this->db->update('customer', $data, ['id_cs' => $id_cs]);
	}

	public function updateUserProfile($id_cs, $data)
	{
		$this->db->update('profiles', $data, ['id_cs' => $id_cs]);
	}

	public function updateTransaction($order_id, $data)
	{
		$this->db->update('transaction', $data, ['order_id' => $order_id]);
	}

	public function updateCartStatus($id_cart, $data)
	{
		$this->db->update('cart', $data, ['id_cart' => $id_cart]);
	}
	public function updateHandle($id_cart, $id_product, $data)
	{
		$this->db->update('cart', $data, ['id_cart' => $id_cart, 'id_product' => $id_product]);
	}



	public function updateOrderHistory($id_cs, $data)
	{
		$this->db->update('order_history', $data, ['id_cs' => $id_cs]);
	}
}
