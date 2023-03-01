<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_artist extends CI_Model
{

    public function insert_profiles_bm($data)
    {
        $this->db->insert('profiles', $data);
    }

    public function get_artist()
    {
        return $this->db->get('profiles')->result_array();
    }
    public function getAllProduct($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('genre', $keyword);
        }
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'product.id_user = user.id_user');
        $this->db->order_by('id_product', 'DESC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }

    public function getProcutOnlyOne()
    {

        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'product.id_user = user.id_user');
        $this->db->order_by('id_product', 'DESC');
        $this->db->limit(1);

        return $this->db->get()->result_array();
    }
    public function countAllProduct($keyword)
    {
        if ($keyword) {
            $this->db->like('genre', $keyword);
        }
        $this->db->select('*');
        $this->db->from('product');
        return $this->db->get()->num_rows();
    }
    public function getAllProductToDisplay()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'product.id_user = user.id_user');
        $this->db->order_by('id_product', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getPignation()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'product.id_user = user.id_user');
        $this->db->order_by('id_product', 'DESC');

        return $this->db->get()->num_rows();
    }

    public function getBeatMaker()
    {
        $this->db->select('*');
        $this->db->from('user');

        $this->db->where('role', 'beatmaker');
        return $this->db->get()->result_array();
    }

    public function getArtistWithId($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('profiles', 'profiles.id_user = user.id_user ', 'left');
        $this->db->where('user.id_user', $id_user);
        return $this->db->get()->row_array();
    }
    public function countAllProductById($keyword)
    {
        if ($keyword) {
            $this->db->like('genre', $keyword);
        }
        $this->db->select('*');
        $this->db->from('product');
        return $this->db->get()->num_rows();
    }
    // public function getBeatById($id_user, $limit, $start, $keyword = null)
    // {
    //     if ($keyword) {
    //         $this->db->like('genre', $keyword);
    //     }
    //     $this->db->select('*');
    //     $this->db->from('product');
    //     $this->db->join('user', 'product.id_user = user.id_user');
    //     $this->db->where('user.id_user', $id_user);
    //     $this->db->order_by('id_product', 'DESC');
    //     $this->db->limit($limit, $start);

    //     return $this->db->get()->result_array();
    // }

    public function getBeatById($id_user)
    {

        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('user', 'product.id_user = user.id_user');
        $this->db->where('user.id_user', $id_user);
        $this->db->order_by('id_product', 'DESC');
        #$this->db->limit($limit, $start);


        return $this->db->get()->result_array();
    }

    public function getCart($id_cs)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('customer', 'customer.id_cs = cart.id_cs ');
        #$this->db->join('product', 'product.id_cs = cart.id_cs ');
        $this->db->where('cart.id_cs =', $id_cs);
        #$this->db->where('cart.id_product =', $id_product);
        return $this->db->get()->result_array();
    }
    public function countAllCart($id_cs)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('customer', 'customer.id_cs = cart.id_cs ');
        #$this->db->join('product', 'product.id_user = cart.id_user ');
        $this->db->where('cart.id_cs =', $id_cs);
        #$this->db->where('cart.id_product =', $id_product);
        return $this->db->count_all_results();
    }

    public function params($id_cs)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('customer', 'customer.id_cs = cart.id_cs ');
        #$this->db->join('product', 'product.id_user = cart.id_user ');
        $this->db->where('cart.id_cs =', $id_cs);

        #$this->db->where('cart.id_product =', $id_product);
        return $this->db->get()->row();
    }

    public function sumSubtotal($id_cs)
    {
        $this->db->select_sum('subtotal');
        $this->db->from('cart');
        $this->db->where('id_cs', $id_cs);
        return $this->db->get()->row()->subtotal;
    }
    // public function sumSubtotal($id_cs)
    // {
    //     $this->db->select_sum('bill_price');
    //     $this->db->from('cart');
    //     $this->db->where('id_cs', $id_cs);
    //     return $this->db->get()->row()->bill_price;
    // }

    public function updateEmailCs($email, $data)
    {
        $this->db->update('customer', $data, ['email' => $email]);
    }

    public function updateEmailBm($email, $data)
    {
        $this->db->update('user', $data, ['email' => $email]);
    }
}
