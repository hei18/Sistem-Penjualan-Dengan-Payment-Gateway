<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_auth extends CI_Model
{
    public function get_fgPw($email)
    {
        $query = $this->db->query("SELECT * FROM user where email = '$email' and is_active = 1");
        return $this->db->get()->result_array($query);
    }
}
