<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Process extends CI_Controller
{
	public function index()
	{
		if (isset($_SESSION['level']) && ($_SESSION['level'] != 3)) {
			redirect('/admin-home');
		} else {
			$data = $this->tpmodel->highlightedpostings();
			$this->load->view('userviews/homepage', array('data' => $data));
		}
	}

	public function openjoinpage()
	{
		if (isset($_SESSION['id'])) {
			redirect('/mypage');
		} else {
			$this->load->view('userviews/join_page');
		}


	}
	public function register()
	{
		$reginfo = $this->input->post(null, true);
		$this->form_validation->set_rules('companyname', 'Company Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('contactname', 'Contact Person', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confpassword', 'Password Confirm', 'required|matches[password]');


		if ($this->form_validation->run() == false) {
			$validationerror = validation_errors();
			$this->load->view('userviews/join_page', array('reginfo' => $reginfo));
		} else {


			$this->tpmodel->insertuser($reginfo);
			$this->session->set_flashdata('message', 'You are successfully registirated!');
			redirect('/joinpage');
		}
	}
	public function login()
	{
		$loginfo = $this->input->post(null, true);

		$email = $loginfo['email'];
		$password = $loginfo['password'];
		$result = $this->tpmodel->login($email, $password);
		$notapproved = $this->tpmodel->accountchecker($email, $password);
		if ($result) {
			$this->session->set_userdata('id', $result['id']);
			$this->session->set_userdata('name', $result['companyname']);
			$this->session->set_userdata('level', $result['adminlevel']);
			if ($result['adminlevel'] != 3) {
				redirect('/admin-home');
			} else {
				redirect('/mypage');
			}

		} else {
			if ($notapproved) {
				$this->session->set_flashdata('logerror', 'Your account is not confirmed !');
				redirect('/joinpage');
			} else {
				$this->session->set_flashdata('logerror', 'Wrong password or email !');
				redirect('/joinpage');
			}
		}
	}

	public function opendetailspage($id)
	{
		if (isset($_SESSION['level']) && $_SESSION['level'] != 3) {
			$data = $this->tpmodel->details($id);
			$this->load->view('adminviews/admindetailspage', array('data' => $data));
		} else {
			$data = $this->tpmodel->details($id);
			$this->load->view('userviews/detailspage', array('data' => $data));
		}

	}
	public function editpage($id)
	{
		$postinfo = $this->tpmodel->editinfo($id);
		if ($_SESSION['level'] != 1) {
			if ($_SESSION['id'] == $postinfo['user_id']) {
				$this->load->view('userviews/editpage', array('postinfo' => $postinfo));
			} else {
				redirect('/');
			}
		} else {
			$this->load->view('userviews/editpage', array('postinfo' => $postinfo));
		}
	}
	public function showcompanylist()
	{
		$this->load->view('userviews/companiespage');
	}
	public function editnow()
	{
		if (isset($_SESSION['id'])) {
			$postinfo = $this->input->post(null, true);
			$this->form_validation->set_rules('tp-title', 'Title', 'required|max_length[255]');
			$this->form_validation->set_rules('tp-description', 'Description', 'required|min_length[10]|max_length[500]');
			$this->form_validation->set_rules('tp-tags', 'Tags', 'required');
			$this->form_validation->set_rules('tp-about', 'About Company', 'required|max_length[500]|min_length[10]');
			$this->form_validation->set_rules('tp-identifies', 'Identifies', 'required');
			$this->form_validation->set_rules('tp-startdate', 'Start Date', 'required');
			$this->form_validation->set_rules('tp-enddate', 'End Date', 'required');
			$this->form_validation->set_rules('tp-link', 'Application Link', 'required|valid_url');

			if ($this->form_validation->run() == false) {
				$validationerror = validation_errors();
				$this->load->view('userviews/editpage', array('postinfo' => $postinfo));
			} else {
				$this->tpmodel->edit($postinfo);
				redirect('/mypage');
			}
		} else {
			redirect('/');
		}

	}


	public function openmainpage()
	{
		$data = $this->tpmodel->mypage($_SESSION['id']);
		$this->load->view('userviews/mainpageuser', array('data' => $data));
	}
	public function newpostingpage()
	{
		$this->load->view('userviews/newposting');
	}

	public function search()
	{
		$result = $this->input->post(null, true);
		$data = $this->tpmodel->search($result['searchinput']);
		$this->load->view('userviews/resultpage', array('data' => $data));
	}

	public function createnewposting()
	{
		$postinfo = $this->input->post(null, true);
		$this->form_validation->set_rules('tp-title', 'Title', 'required|min_length[12]|max_length[255]');
		$this->form_validation->set_rules('tp-description', 'Description', 'required|min_length[80]|max_length[500]');
		$this->form_validation->set_rules('tp-tags', 'Tags', 'required');
		$this->form_validation->set_rules('tp-about', 'About Company', 'required|max_length[500]|min_length[20]');
		$this->form_validation->set_rules('tp-identifies', 'Identifies', 'required');
		$this->form_validation->set_rules('tp-startdate', 'Start Date', 'required');
		$this->form_validation->set_rules('tp-enddate', 'End Date', 'required');
		$this->form_validation->set_rules('tp-link', 'Application Link', 'required|valid_url');

		if ($this->form_validation->run() == false) {
			$validationerror = validation_errors();
			$this->load->view('userviews/newposting', array('postinfo' => $postinfo));
		} else {

			$this->tpmodel->insertpostings($postinfo);
			redirect('/mypage');
		}
	}

	public function jobspage()
	{
		$data = $this->tpmodel->activepostings();
		$this->load->view('userviews/jobspage', array('data' => $data));
	}


	public function logout()
	{
		session_destroy();
		redirect('/');


	}
}
