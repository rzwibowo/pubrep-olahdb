<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Master_operator extends CI_Controller
{
	function operator()
	{
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$this->load->view('app/mod_operator/operator');
	}


	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT l.nama_level, o.*
                                FROM tbl_operator o
								LEFT JOIN tbl_level l ON o.id_level = l.id_level                               
                                WHERE o.status_operator = 'Y' 
								AND o.nama_operator like '%" . $cari . "%'
								ORDER BY o.nama_operator ASC");
		$data = array('operator' => $data);
		$this->load->view('app/mod_operator/cari_ajax', $data);
	}

	function cari_operator()
	{
		header("Content-Type: application/json");

		$cari = $this->input->get('term');
		$result = [];
		$data = $this->db->query("SELECT o.*
                                FROM tbl_operator o                                                          
                                WHERE o.status_operator = 'Y' 
								AND o.nama_operator like '%" . $cari . "%'								
								ORDER BY o.nama_operator ASC 
								LIMIT 100")->result();
		if (sizeof($data) > 0) {
			$result = $data;
		}

		echo json_encode($result);
	}

	function operator_tambah()
	{
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$data['level'] = $this->model_app->view_where_asc(
			'tbl_level',
			array('status_level' => 'Y'),
			'id_level'
		);
		$this->load->view('app/mod_operator/operator_tambah', $data);
	}

	function operator_simpan()
	{
		$tanggal    = date('Y-m-d H:i:s');
		$notif = '';

		$data = array(
			'username_operator' => $this->input->post('username_operator'),
			'password_operator' => md5($this->input->post('password_operator')),
			'nama_operator' => $this->input->post('nama_operator'),
			'telp_operator' => $this->input->post('telp_operator'),
			'alamat_operator' => $this->input->post('alamat_operator'),
			'id_level' => $this->input->post('id_level'),
			'waktu_input' => $tanggal
		);

		$qry = $this->db->query("SELECT o.*   
					FROM   tbl_operator o                               
				WHERE  o.status_operator <> 'N'
				and    o.username_operator ='" . $data['username_operator'] . "' ");
		$cek = $qry->num_rows();

		if ($cek > 0) {
			$notif = 'uname-err';

			$this->session->set_flashdata('data', $data);
			$this->session->set_flashdata('notifikasi', $notif);
			redirect('master_operator/operator_tambah');
		} else {
			if ($this->input->post('foto_operator') != '') {
				$data['foto_operator'] = $this->input->post('foto_operator');
			} else {
				$data['foto_operator'] = 'no_gambar.jpg';
			}

			$insert = $this->db->insert('tbl_operator', $data);
			if ($insert) {
				redirect('master_operator/operator');
			} else {
				// $data_result->status = 'save-err';
			}
		}
	}

	function foto_simpan()
	{
		header("Content-Type: application/json");
		$filename = null;

		$conf['upload_path'] = 'assets/gambar/operator/';
		$conf['allowed_types'] = 'jpg|png';
		$conf['file_name'] = 'operator-' . uniqid() . '-' . time();
		$conf['overwrite'] = true;
		$conf['max_size'] = 1024;

		$data_result = new stdClass();

		$this->load->library('upload', $conf);

		if ($this->upload->do_upload('file')) {
			$filename = $this->upload->data('file_name');
			$data_result->status = 'save-ok';
			$data_result->filename = $filename;
		} else {
			$data_result->status = 'save-err';
			$data_result->message = $this->upload->display_errors();
		}

		echo json_encode($data_result);
	}

	function operator_edit()
	{
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$id = $this->uri->segment(3);

		$data['level'] = $this->model_app->view_where_asc(
			'tbl_level',
			array('status_level' => 'Y'),
			'id_level'
		);

		$data['operator'] = $this->model_app->edit('tbl_operator', array('id_operator' => $id))->row_array();
		$this->load->view('app/mod_operator/operator_edit', $data);
	}

	function operator_edit_simpan()
	{
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		$old_username = $this->input->post('username_operator_old');

		$notif = '';

		$data = array(
			'username_operator' => $this->input->post('username_operator'),
			'nama_operator' => $this->input->post('nama_operator'),
			'telp_operator' => $this->input->post('telp_operator'),
			'alamat_operator' => $this->input->post('alamat_operator'),
			'id_level' => $this->input->post('id_level'),
			'waktu_input' => $tanggal
		);

		$cek = 0;

		if ($old_username != $data['username_operator']) {
			//cek username 
			$qry = $this->db->query("SELECT o.*   
									 FROM   tbl_operator o                               
									WHERE  o.status_operator <> 'N'
									and    o.username_operator ='" . $data['username_operator'] . "' ");
			$cek = $qry->num_rows();
		}

		if ($this->input->post('foto_operator') != '') {
			$data['foto_operator'] = $this->input->post('foto_operator');
		}

		if (trim($this->input->post('password_operator')) != '') {
			$data['password_operator'] = md5($this->input->post('password_operator'));
		}

		if ($cek == 0 || $old_username == $data['username_operator']) {
			$where = array('id_operator' => $this->input->post('id_operator'));
			$this->model_app->update('tbl_operator', $data, $where);
			redirect('master_operator/operator');
		} else {
			$notif = 'uname-err';
			$this->session->set_flashdata('notifikasi', $notif);
			redirect('master_operator/operator_edit/' . $this->input->post('id_operator'));
		}
	}

	function operator_hapus()
	{
		$id    = $this->input->post('id_operator');
		$where = array('id_operator' => $id);
		$data  = array('status_operator' => 'N');
		$this->model_app->update('tbl_operator', $data, $where);
	}
}
