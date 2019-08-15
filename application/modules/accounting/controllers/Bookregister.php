<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bookregister extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('Bookregister_model', 'book');
		$this->data['customjs'] = 'bookregister_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'bookregister_view';
		$this->data['page_title'] = 'Book Registers';
		$this->data['records'] = $this->book->getBooks();

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertBook(){
		$info = [
			'book_code' => strtoupper($this->input->post('book_code')),
			'book_reference' => $this->input->post('book_reference'),
			'book_description' => $this->input->post('book_description')
		];
		$this->book->insertBook($info);
		redirect('Accounting/Bookregister', 'refresh');
	}

	public function updateBook(){
		$info = [
			'book_code' => strtoupper($this->input->post('book_code')),
			'book_reference' => $this->input->post('book_reference'),
			'book_description' => $this->input->post('book_description')
		];
		$this->book->updateBook($info, $this->input->post('book_register_id'));
		redirect('Accounting/Bookregister', 'refresh');
	}

	public function checkSubCode(){
		$data = $this->book->checkSubCode($this->input->post('book_code'), $this->input->post('book_id'));
		echo json_encode($data);
		//$data = $this->book->checkSubCode('0A', '1');
		//var_dump($data);
	}
} 