<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


	public function checar_usuario($data = array())
	{
	   $where = "(email ='".$data['email']."' OR usuario = '".$data['email']."')";

		return $this->db->select("*")
			->from('admin')
			->where('senha', md5($data['senha']))
			->where('status', 1)
			->where($where)
			->get();
	}

	public function criar_admin($data = array())
	{
		return $this->db->insert('admin', $data);
	}


}
 