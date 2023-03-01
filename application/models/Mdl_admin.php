<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_admin extends CI_Model
{
	public function getById($id_admin)
	{
		return $this->db->get_where('administrator', ['id_admin' => $id_admin])->row_array();
	}
	public function getByIdCs($id_cs)
	{
		return $this->db->get_where('customer', ['id_cs' => $id_cs])->row_array();
	}

	public function getByIdBm($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user])->row_array();
	}

	public function getIncome()
	{
		$this->db->select('*');
		$this->db->from('income');
		return $this->db->get()->result_array();
	}

	public function getTotal()
	{
		$this->db->select_sum('ppn_income');
		$this->db->from('income');

		return $this->db->get()->row()->ppn_income;
	}
	public function getUserData($id_user)
	{
		$this->db->select('*');
		$this->db->from('profiles');
		$this->db->join('user', 'user.id_user = profiles.id_user',);
		#$this->db->join('data_bank', 'data_bank.id_user = user.id_user', 'left');
		$this->db->where('profiles.id_user', $id_user);
		$this->db->where('user.role', 'beatmaker');

		return $this->db->get()->row_array();
	}
	public function getUserBank($id_user)
	{
		$this->db->select('*');
		$this->db->from('data_bank');


		$this->db->where('data_bank.id_user', $id_user);

		return $this->db->get()->result_array();
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
	public function getAllUserBeatmaker()
	{
		$this->db->select('*');
		$this->db->from('user');
		#$this->db->join('profiles', 'profiles.id_user = user.id_user',);
		#$this->db->join('data_bank', 'data_bank.id_user = user.id_user', 'left');
		$this->db->where('role', 'beatmaker');
		$this->db->order_by('id_user', 'DESC');
		return $this->db->get()->result_array();
	}
	public function getAllUserCustomer()
	{
		$this->db->select('*');
		$this->db->from('customer');
		#$this->db->join('profiles', 'profiles.id_cs = customer.id_cs', 'left');
		$this->db->where('role', 'customer');
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
		$this->db->order_by('id_transaction', 'DESC');
		#$this->db->order_by('order_id');

		return $this->db->get()->result_array();
	}

	public function getHistory($id_cs, $order_id)
	{
		$this->db->select('*');
		$this->db->from('order_history');
		#$this->db->join('cart', 'cart.id_cart = transaction.id_cart');
		#$this->db->join('product', 'product.id_product = transaction.id_product');
		$this->db->join('customer', 'customer.id_cs = order_history.id_cs');
		#$this->db->join('product', 'product.id_product = order_history.Id_product');
		$this->db->where('order_history.id_cs =', $id_cs);
		$this->db->where('order_history.order_id =', $order_id);
		return $this->db->get()->result_array();
	}

	public function getCustomerDetail($id_cs)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('profiles', 'profiles.id_cs = customer.id_cs');
		$this->db->where('role', 'customer');
		$this->db->where('customer.id_cs', $id_cs);
		return $this->db->get()->row_array();
	}
	public function getAllCs()
	{
		$this->db->select('*');
		$this->db->from('customer');
		#$this->db->where('role', 'beatmaker');
		return $this->db->count_all_results();
	}
	public function getAllWd()
	{
		$this->db->select('*');
		$this->db->from('income');
		$this->db->where('status_income', 0);
		return $this->db->count_all_results();
	}

	public function getAllWithdraw()
	{
		$this->db->select('*');
		$this->db->from('income');
		// $this->db->where('status_income', 0);
		return $this->db->get()->result_array();
	}
	public function getAllProduct()
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('user', 'user.id_user = product.id_user');
		$this->db->join('profiles', 'user.id_user = profiles.id_user');
		$this->db->where('role', 'beatmaker');
		$this->db->order_by('id_product', 'DESC');

		return $this->db->get()->result_array();
	}
	public function getByIdProduct($id_product)
	{
		return $this->db->get_where('product', ['id_product' => $id_product])->row_array();
	}
	public function getProductByRequestt($id_user)
	{
		return $this->db->get_where('product', ['id_user' => $id_user])->result_array();
	}

	public function getPPN()
	{
		return $this->db->query('SELECT SUM(ppn_income) AS ppn FROM income')->row()->ppn;
	}
	/**
	 * Update
	 */
	public function updateIncome($email, $data)
	{
		$this->db->update('income', $data, ['email' => $email]);
	}

	public function updatePassword($id_admin, $data)
	{
		$this->db->update('administrator', $data, ['id_admin' => $id_admin]);
	}
	public function updateProduct($id_product, $data)
	{
		$this->db->update('product', $data, ['id_product' => $id_product]);
	}
	/**
	 * Delete
	 */
	public function deleteContentData($id_product)
	{
		$this->db->where('id_product', $id_product);
		return $this->db->delete('product');
	}

	public function deleteByRequest($id_user)
	{
		$this->db->where('id_user', $id_user);
		return $this->db->delete('product');
	}
	public function deleteUserByRequest($id_user)
	{
		$this->db->where('id_user', $id_user);
		return $this->db->delete('user');
	}

	public function deleteCustomerByRequest($id_cs)
	{
		$this->db->where('id_cs', $id_cs);
		return $this->db->delete('customer');
	}
}
