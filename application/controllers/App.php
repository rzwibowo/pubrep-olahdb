<?php
//print_r( $this->db->last_query()); exit();
defined('BASEPATH') OR exit('No direct script access allowed');
class App extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username_operator = $this->input->post('username_operator');
			$password_operator = md5($this->input->post('password_operator'));
			$cek = $this->model_app->cek_login($username_operator,$password_operator);

		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				
				$this->session->set_userdata(array(
					'id_operator'    =>$row['id_operator'],
					'nama_operator'	 =>$row['nama_operator'],
					'id_level'	     =>$row['id_level'],
					'foto_operator'	 =>$row['foto_operator']
				   ));				 
				redirect('app/home');
			}else{
				$this->session->set_flashdata("flash_msg", "Data tidak ditemukan");				
				$this->load->view('app/login');
			}
		}else{
			if ($this->session->level != ''){
				redirect('app/home');
			}else{
				$this->load->view('app/login');
			}
		}

	}

	function logout(){
		$this->session->sess_destroy();
		redirect('app');
	}

	function home(){
		//cek_session_admin();
		$this->load->view('app/home');
	}

	function cek_authentifikasi(){
		$password_auth    = $this->input->post('password_auth');
		$query = $this->db->query("select * from tbl_auth where password_auth ='".$password_auth."'");
		
		if ($query->num_rows() > 0){
			echo "Y";
		}else{
			echo "N";
		}
			
	}

}