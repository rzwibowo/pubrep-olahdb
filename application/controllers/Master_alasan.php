<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_alasan extends CI_Controller {
	function alasan(){
		cek_session_admin();
		cek_session_cs();		
        $this->load->view('app/mod_alasan/alasan');
    }
	
	
	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT *
                                FROM tbl_alasan                                                      
                                WHERE status_alasan = 'Y' 
								AND nama_alasan like '%".$cari."%'
								ORDER BY id_alasan ASC");
		$data = array('alasan' => $data);      
        $this->load->view('app/mod_alasan/cari_ajax', $data);

	}
	
    function alasan_tambah(){
        cek_session_admin();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])){
			$data = array(
						  'nama_alasan' => $this->input->post('nama_alasan'),
						  'id_operator' => $this->session->id_operator,
						  'waktu_input' => $tanggal
						 );
			$this->model_app->insert('tbl_alasan',$data);
			$this->session->set_flashdata("flash_msg", "Data berhasil ditambahkan");			
			redirect('master_alasan/alasan');
		}else{
			$this->load->view('app/mod_alasan/alasan_tambah');
		}
    }
    
    function alasan_edit(){
        cek_session_admin();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){		
            $data = array(
							'nama_alasan' => $this->input->post('nama_alasan'),
							'id_operator' => $this->session->id_operator
						 );
            $where = array('id_alasan' => $this->input->post('id_alasan'));
            $this->model_app->update('tbl_alasan', $data, $where);
			$this->session->set_flashdata("flash_msg", "Data berhasil diupdate");	
            redirect('master_alasan/alasan');	        
		}else{
			$qry  = $this->model_app->edit('tbl_alasan', array('id_alasan' => $id))->row_array();
			$data = array('alasan' => $qry);			
			$this->load->view('app/mod_alasan/alasan_edit',$data);
		}
    }
    
    function alasan_hapus(){
		$id    = $this->input->post('id_alasan');
		$where = array('id_alasan' => $id);
		$data  = array('status_alasan' => 'N');
		$this->model_app->update('tbl_alasan', $data, $where);	
		$this->session->set_flashdata("flash_msg", "Data berhasil dihapus");	
	}

	
}