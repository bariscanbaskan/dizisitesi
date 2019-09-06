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
		$this->load->view('front/anasayfa');
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
}
