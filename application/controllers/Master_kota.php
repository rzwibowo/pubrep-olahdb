<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Master_kota extends CI_Controller
{
	function kota()
	{
		cek_session_admin();
		cek_session_cs();
		$this->load->view('app/mod_kota/kota');
	}


	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT k.*, p.nama_propinsi
                                FROM tbl_kota k
                                LEFT JOIN tbl_propinsi p ON k.id_propinsi = p.id_propinsi                                                          
                                WHERE k.status_kota = 'Y' 
								AND k.nama_kota like '%" . $cari . "%'								
								ORDER BY k.nama_kota ASC 
								LIMIT 100");
		$data = array('kota' => $data);
		$this->load->view('app/mod_kota/cari_ajax', $data);
	}

	function cari_kota()
	{
		header("Content-Type: application/json");

		$cari = $this->input->get('term');
		$result = [];
		$data = $this->db->query("SELECT k.*
                                FROM tbl_kota k                                                          
                                WHERE k.status_kota = 'Y' 
								AND k.nama_kota like '%" . $cari . "%'								
								ORDER BY k.nama_kota ASC 
								LIMIT 100")->result();
		if (sizeof($data) > 0) {
			$result = $data;
		}

		echo json_encode($result);
	}

	function kota_tambah()
	{
		cek_session_admin();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])) {
			$data = array(
				'id_propinsi' => $this->input->post('id_propinsi'),
				'nama_kota' => $this->input->post('nama_kota')
			);
			$this->model_app->insert('tbl_kota', $data);
			redirect('master_kota/kota');
		} else {
			$data['propinsi'] = $this->model_app->view_where_asc(
				'tbl_propinsi',
				array('status_propinsi' => 'Y'),
				'id_propinsi'
			);
			$this->load->view('app/mod_kota/kota_tambah', $data);
		}
	}

	function kota_edit()
	{
		cek_session_admin();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$data = array(
				'id_propinsi' => $this->input->post('id_propinsi'),
				'nama_kota' => $this->input->post('nama_kota')
			);
			$where = array('id_kota' => $this->input->post('id_kota'));
			$this->model_app->update('tbl_kota', $data, $where);
			redirect('master_kota/kota');
		} else {
			$qry  = $this->model_app->edit('tbl_kota', array('id_kota' => $id))->row_array();
			$data = array('kota' => $qry);
			$data['propinsi'] = $this->model_app->view_where_asc(
				'tbl_propinsi',
				array('status_propinsi' => 'Y'),
				'id_propinsi'
			);
			$this->load->view('app/mod_kota/kota_edit', $data);
		}
	}

	function kota_hapus()
	{
		$id    = $this->input->post('id_kota');
		$where = array('id_kota' => $id);
		$data  = array('status_kota' => 'N');
		$this->model_app->update('tbl_kota', $data, $where);
	}

	function kota_by_propinsi()
	{
		header("Content-Type: application/json");
		$data_result = array();

		$id    = $this->input->post('id_propinsi');

		$data = $this->model_app->view_where_asc(
			'tbl_kota',
			array('status_kota' => 'Y', 'id_propinsi' => $id),
			'nama_kota'
		);

		$data_result = $data;
		echo json_encode($data_result);
	}
}
