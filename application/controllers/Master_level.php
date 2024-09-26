<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_level extends CI_Controller {
	function level(){
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();		
        $this->load->view('app/mod_level/level');
    }
	
	
	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT *
                                FROM tbl_level                                                      
                                WHERE status_level = 'Y' 
								AND nama_level like '%".$cari."%'
								ORDER BY id_level ASC");
		$data = array('level' => $data);      
        $this->load->view('app/mod_level/cari_ajax', $data);

	}
	
    function level_tambah(){
        cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])){
			$data = array(
						  'nama_level' => $this->input->post('nama_level'),
						  'id_operator' => $this->session->id_operator,
						  'waktu_input' => $tanggal
						 );
			$this->model_app->insert('tbl_level',$data);
			$this->session->set_flashdata("flash_msg", "Data berhasil ditambahkan");			
			redirect('master_level/level');
		}else{
			$this->load->view('app/mod_level/level_tambah');
		}
    }
    
    function level_edit(){
        cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){		
            $data = array(
							'nama_level' => $this->input->post('nama_level'),
							'id_operator' => $this->session->id_operator
						 );
            $where = array('id_level' => $this->input->post('id_level'));
            $this->model_app->update('tbl_level', $data, $where);
			$this->session->set_flashdata("flash_msg", "Data berhasil diupdate");	
            redirect('master_level/level');	        
		}else{
			$qry  = $this->model_app->edit('tbl_level', array('id_level' => $id))->row_array();
			$data = array('level' => $qry);			
			$this->load->view('app/mod_level/level_edit',$data);
		}
    }
    
    function level_hapus(){
		$id    = $this->input->post('id_level');
		$where = array('id_level' => $id);
		$data  = array('status_level' => 'N');
		$this->model_app->update('tbl_level', $data, $where);	
		$this->session->set_flashdata("flash_msg", "Data berhasil dihapus");	
	}

	
}