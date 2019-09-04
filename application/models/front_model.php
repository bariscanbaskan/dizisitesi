<?php
class front_model extends CI_Model
{
	public function users($arrayWhere = array() ){
		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}

	function addAdmin ($formData)
	{
		$insertData = array(
			'Email'=>$formData['Email'],
			'Password'=>$formData['Password'],
		);
		$this->db->insert('users',$insertData);
	}
}

?>
