<?php
class front_model extends CI_Model
{
	//------------------------------------------Start Listeleme---------------------------------------------------------
	public function getAdmins($arrayWhere = array() ){
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

	public function urunler($arrayWhere = array() ){
		$query = $this->db->get('urunler');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	//------------------------------------------finish Listeleme--------------------------------------------------------

	function kayitol ($formData)
	{
		$insertData = array(
			'email'=>$formData['email'],
			'username'=>$formData['username'],
			'password'=>$formData['password'],
			'repassword'=>$formData['repassword'],
			'status'=>$formData['status']
		);

		$this->db->insert('users',$insertData);
	}
	function girisyap ($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$query=$this->db->get('users');
		return $query->result();
	}

	function deleteUser ($whereData)
	{

		$resultArray = array(
			'Errors' => array(),
			'Data' => array()
		);
		$this->db->where($whereData);
		$this->db->delete('users');

		$deleteResult = ($this->db->affected_rows() != 1) ? false : true;
		if($deleteResult == true) {
			$resultArray['Data'] = array('ok');
		} else {
			$resultArray['Errors'] = array('hata');
		}

		return $resultArray;
	}

	function deleteUrunler ($whereData)
	{

		$resultArray = array(
			'Errors' => array(),
			'Data' => array()
		);
		$this->db->where($whereData);
		$this->db->delete('urunler');

		$deleteResult = ($this->db->affected_rows() != 1) ? false : true;
		if($deleteResult == true) {
			$resultArray['Data'] = array('ok');
		} else {
			$resultArray['Errors'] = array('hata');
		}

		return $resultArray;
	}

	function UpdateAdmin($whereData ,$formData)
	{
		$resultArray = array(
			'Errors' => array(),
			'Data' => array()
		);

		$updateData = array(
			'username'=>$formData['username']);

		$this->db->where($whereData);
		$this->db->update('users',$updateData);
		$updateResult = ($this->db->affected_rows() != 1) ? false : true;
		if($updateResult == true) {
			$resultArray['Data'] = $this->getAdmins(array('Id'=>$whereData['Id']));
		} else {
			$resultArray['Errors'] = array('hatali oldu');
		}
		return $resultArray;
	}



}

?>
