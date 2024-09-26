<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_lokasi extends CI_Controller {
	function lokasi(){
		cek_session_admin();		
		cek_session_cs();
        $this->load->view('app/mod_lokasi/lokasi');
    }
	
	
	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT l.*, p.nama_perusahaan
                                FROM tbl_lokasi l
                                LEFT JOIN tbl_perusahaan p ON l.id_perusahaan = p.id_perusahaan                                                          
                                WHERE l.status_lokasi = 'Y' 
								AND l.nama_lokasi like '%".$cari."%'
								ORDER BY l.id_lokasi ASC");
		$data = array('lokasi' => $data);      
        $this->load->view('app/mod_lokasi/cari_ajax', $data);

	}
	
    function lokasi_tambah(){
        cek_session_admin();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])){
			$data = array('id_perusahaan' => $this->input->post('id_perusahaan'),
						  'nama_lokasi' => $this->input->post('nama_lokasi'),
						  'id_operator' => $this->session->id_operator,
						  'waktu_input' => $tanggal
						 );
			$this->model_app->insert('tbl_lokasi',$data);			
			redirect('master_lokasi/lokasi');
		}else{
			$data['perusahaan'] = $this->model_app->view_where_asc(
				'tbl_perusahaan',
				array('status_perusahaan' => 'Y'),
				'id_perusahaan'
			);
			$this->load->view('app/mod_lokasi/lokasi_tambah',$data);
		}
    }
    
    function lokasi_edit(){
        cek_session_admin();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){		
            $data = array('id_perusahaan' => $this->input->post('id_perusahaan'),
						  'nama_lokasi' => $this->input->post('nama_lokasi'),
						  'id_operator' => $this->session->id_operator
						 );
            $where = array('id_lokasi' => $this->input->post('id_lokasi'));
            $this->model_app->update('tbl_lokasi', $data, $where);
            redirect('master_lokasi/lokasi');
	        
		}else{
			$qry  = $this->model_app->edit('tbl_lokasi', array('id_lokasi' => $id))->row_array();
			$data = array('lokasi' => $qry);
			$data['perusahaan'] = $this->model_app->view_where_asc(
				'tbl_perusahaan',
				array('status_perusahaan' => 'Y'),
				'id_perusahaan'
			);
			$this->load->view('app/mod_lokasi/lokasi_edit',$data);
		}
    }
    
    function lokasi_hapus(){
		$id    = $this->input->post('id_lokasi');
		$where = array('id_lokasi' => $id);
		$data  = array('status_lokasi' => 'N');
		$this->model_app->update('tbl_lokasi', $data, $where);	
	}

	
}