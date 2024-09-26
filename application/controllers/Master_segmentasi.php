<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_segmentasi extends CI_Controller {
	function segmentasi(){
		cek_session_admin();		
		cek_session_cs();
        $this->load->view('app/mod_segmentasi/segmentasi');
    }
	
	
	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT *
                                FROM tbl_segmentasi                                                      
                                WHERE status_segmentasi = 'Y' 
								AND nama_segmentasi like '%".$cari."%'
								ORDER BY id_segmentasi ASC");
		$data = array('segmentasi' => $data);      
        $this->load->view('app/mod_segmentasi/cari_ajax', $data);

	}
	
    function segmentasi_tambah(){
        cek_session_admin();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])){
			$data = array(
						  'nama_segmentasi' => $this->input->post('nama_segmentasi'),
						  'id_operator' => $this->session->id_operator,
						  'waktu_input' => $tanggal
						 );
			$this->model_app->insert('tbl_segmentasi',$data);
			$this->session->set_flashdata("flash_msg", "Data berhasil ditambahkan");			
			redirect('master_segmentasi/segmentasi');
		}else{
			$this->load->view('app/mod_segmentasi/segmentasi_tambah');
		}
    }
    
    function segmentasi_edit(){
        cek_session_admin();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){		
            $data = array(
							'nama_segmentasi' => $this->input->post('nama_segmentasi'),
							'id_operator' => $this->session->id_operator
						 );
            $where = array('id_segmentasi' => $this->input->post('id_segmentasi'));
            $this->model_app->update('tbl_segmentasi', $data, $where);
			$this->session->set_flashdata("flash_msg", "Data berhasil diupdate");	
            redirect('master_segmentasi/segmentasi');	        
		}else{
			$qry  = $this->model_app->edit('tbl_segmentasi', array('id_segmentasi' => $id))->row_array();
			$data = array('segmentasi' => $qry);			
			$this->load->view('app/mod_segmentasi/segmentasi_edit',$data);
		}
    }
    
    function segmentasi_hapus(){
		$id    = $this->input->post('id_segmentasi');
		$where = array('id_segmentasi' => $id);
		$data  = array('status_segmentasi' => 'N');
		$this->model_app->update('tbl_segmentasi', $data, $where);	
		$this->session->set_flashdata("flash_msg", "Data berhasil dihapus");	
	}

	
}