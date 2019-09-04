<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('front_model');
	}

	public function index()
	{
		$this->load->view('front/welcome_message');
	}

	public function index1()
	{
			$data = array();
			$data['View']='front/users';
			if(!empty($this->input->post()))
			{
				$formData=array(
					'Email'=>$this->input->post('Email'),
					'Password'=>$this->input->post('Password'),
				);
				$resultArray = $this->front_model->addAdmin($formData);
			}

			$this->load->view('front/users', $data);
		}
}
