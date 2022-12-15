<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_bm extends CI_Model
{
    public function getByIdBm($id_user)
    {
        return $this->db->get_where('user', ['id_user' => $id_user])->row_array();
    }


    public function getMyBank($id_user)
    {
        return $this->db->get_where('data_bank', ['id_user' => $id_user])->result_array();
    }
    public function getByProfile($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('profiles', 'profiles.id_user = user.id_user', 'left');
        $this->db->join('data_bank', 'data_bank.id_user = user.id_user', 'left');
        $this->db->where('user.id_user =', $id_user);

        return $this->db->get()->row_array();
    }
    public function getWd($id_user)
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->join('user', 'user.id_user = income.id_user');
        $this->db->where('income.id_user =', $id_user);
        return $this->db->get()->result_array();
    }
    public function getValidateWd($id_user)
    {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->join('user', 'user.id_user = income.id_user');
        $this->db->where('income.id_user =', $id_user);
        $this->db->where('income.status_income =', 0);
        return $this->db->get()->row_array();
    }
    public function getByProducts($id_user)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'user.id_user = product.id_user');
        $this->db->where('product.id_user', $id_user);
        return $this->db->get()->result_array();
    }
    public function getProfile($id_user)
    {
        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->join('user', 'user.id_user = profiles.id_user',);

        $this->db->where('profiles.id_user =', $id_user);

        return $this->db->get()->result_array();
    }
    public function getProfileRequest($id_user)
    {
        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->join('user', 'user.id_user = profiles.id_user',);

        $this->db->where('profiles.id_user =', $id_user);

        return $this->db->get()->row_array();
    }

    public function getBank($id_user)
    {
        $this->db->select('*');
        $this->db->from('data_bank');
        $this->db->join('user', 'user.id_user = data_bank.id_user',);

        $this->db->where('data_bank.id_user =', $id_user);

        return $this->db->get()->result_array();
    }

    public function getByIdProduct($id_product)
    {
        return $this->db->get_where('product', ['id_product' => $id_product])->row_array();
    }
    public function getByIdBank($id_bank)
    {
        return $this->db->get_where('data_bank', ['id_bank' => $id_bank])->row_array();
    }
    public function getIncome($id_user)
    {
        return $this->db->query('SELECT SUM(sales*price) AS income FROM product INNER JOIN user ON user.id_user = product.id_user WHERE product.id_user =' . $id_user)->row()->income;
    }
    public function getPPN($id_user)
    {
        return $this->db->query('SELECT SUM(sales*ppn) AS ppn FROM product INNER JOIN user ON user.id_user = product.id_user WHERE product.id_user =' . $id_user)->row()->ppn;
    }
    /**
     * Update
     *
     *
     */
    public function updateUserProfile($id_user, $data)
    {
        $this->db->update('profiles', $data, ['id_user' => $id_user]);
    }
    public function updateProduct($id_user, $data)
    {
        $this->db->update('product', $data, ['id_user' => $id_user]);
    }
    public function updatePassword($id_user, $data)
    {
        $this->db->update('user', $data, ['id_user' => $id_user]);
    }
    public function update_user($id_user, $data)
    {
        $this->db->update('user', $data, ['id_user' => $id_user]);
    }

    public function updateIncome($email, $data)
    {
        $this->db->update('income', $data, ['email' => $email]);
    }



    /**
     * DELETE
     */

    public function deleteContentData($id_product)
    {
        $this->db->where('id_product', $id_product);
        return $this->db->delete('product');
    }

    public function deleteBankAccount($id_bank)
    {
        $this->db->where('id_bank', $id_bank);
        return $this->db->delete('data_bank');
    }
}
