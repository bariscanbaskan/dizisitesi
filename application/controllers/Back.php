<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('front_model');
	}

	public function index()
	{
		$data=array();
		$data['admins'] = $this->front_model->getAdmins();
		$data['View'] = 'back/admins';
		$this->load->view('back/template',$data);
	}

	public function girisyap()
	{
		$username= $this->input->post('username'); //sayfadaki username isimli input taki girileni almak icin kullanilir
		$password= $this->input->post('password');
		$giris=$this->front_model->girisyap($username,$password); //sayfadaki username ve passwoord degerlerini giris degiskenine aktardik -> front model icindeki girisyap fonksiyonuna
		if ($giris)
		{
			echo "basarili";
		}
		else{
			echo 'giris basarisiz';
		}
	}

	public function deleteUser($id)
	{
		$whereData=array('id'=>$id);
		$resultArray=$this->front_model->deleteUser($whereData);

		if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
			$this->session->set_flashdata('MessageType','danger');
			$this->session->set_flashdata('Message',$resultArray['Errors'][0]);
			return;
		} else if(count($resultArray['Data']) > 0) {
			$this->session->set_flashdata('MessageType','success');
			$this->session->set_flashdata('Message','Basariyla silindi');
		}
		redirect(base_url().'Back/getAdmins');
	}

	public function deleteUrunler($id)
	{
		$whereData=array('urun_id'=>$id);
		$resultArray=$this->front_model->deleteUrunler($whereData);

		if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
			$this->session->set_flashdata('MessageType','danger');
			$this->session->set_flashdata('Message',$resultArray['Errors'][0]);
			return;
		} else if(count($resultArray['Data']) > 0) {
			$this->session->set_flashdata('MessageType','success');
			$this->session->set_flashdata('Message','Basariyla silindi');
		}
		redirect(base_url().'Back/urunler');
	}
//------------------------------------------start Listeleme----------------------------------------------------------------

	public function kayitol()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('email','email','required'); //set rules icindekiler: birincisi input name ikincisi isimlendirme ucuncusu parametreler ornek: required bos birakilamaz
		$this->form_validation->set_rules('password','password');
		$this->form_validation->set_rules('repassword','repassword');
		$this->form_validation->set_message('email','required','email Bos birakilamaz ');
		$this->form_validation->set_message('username','required','name Bos birakilamaz ');

		if ($this->form_validation->run())
		{
			$username= $this->input->post('username'); //sayfadaki username isimli input taki girileni almak icin kullanilir
			$email= $this->input->post('email');
			$password= $this->input->post('password');
			$repassword= $this->input->post('repassword');

			$data =array(
				'username'=>$username,
				'email'=>$email,
				'password'=>$password,
				'repassword'=>$repassword,
				'status'=>0
			);
			$this->front_model->kayitol($data);
			$this->load->view('front/anasayfa');
		}
		else
		{
			$this->load->view('front/anasayfa');
		}
	}
//------------------------------------------start Listeleme----------------------------------------------------------------
	public function getAdmins()
	{
		$data=array();
		$data['admins'] = $this->front_model->getAdmins();
		$data['View'] = 'back/admins';
		$this->load->view('back/template',$data);
	}

	public function urunler()
	{
		$data=array();
		$data['urunler'] = $this->front_model->urunler();
		$data['View'] = 'back/urunler';
		$this->load->view('back/template',$data);
	}

//------------------------------------------finish Listeleme----------------------------------------------------------------
	function UpdateAdmin($adminId){
		$data = array();
		$data['AdminDetail'] = $this->front_model->getAdmins(array('Id'=> $adminId));
		$data['MetaTitle']='UpdateAdmin';
		$data['MetaDescription']='back/UpdateAdmin';
		$data['View']='back/UpdateAdmin';

		if(!empty($this->input->post()))
		{
			$this-> form_validation->set_rules('username', 'username', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('MessageType','danger');
				$this->session->set_flashdata('Message', validation_errors());
				$this->load->view('admin/template', $data);
				return;
			}

			$formData=array(
				'username'=>$this->input->post('username'),
			);

			$whereData = array('Id' =>$adminId);
			$resultArray = $this->front_model->UpdateAdmin($whereData,$formData);

			if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
				$this->session->set_flashdata('MessageType','danger');
				$this->session->set_flashdata('Message',$resultArray['Errors'][0]);
				return;
			} else if(count($resultArray['Data']) > 0) {
				$this->session->set_flashdata('MessageType','success');
				$this->session->set_flashdata('Message', 'ok');
				redirect(base_url() . 'back/getAdmins/'.$adminId);
			}

			$this->session->set_flashdata('MessageType','danger');
			$this->session->set_flashdata('Message', 'somethingWentWrong');
		}

		$this->load->view('back/template', $data);
	}

}
