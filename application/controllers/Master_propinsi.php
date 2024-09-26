<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_propinsi extends CI_Controller {
	function propinsi(){
		cek_session_admin();		
		cek_session_cs();
        $this->load->view('app/mod_propinsi/propinsi');
    }
	
	
	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT *
                                FROM tbl_propinsi                                                         
                                WHERE status_propinsi = 'Y' 
								AND nama_propinsi like '%".$cari."%'
								ORDER BY id_propinsi ASC");
		$data = array('propinsi' => $data);      
        $this->load->view('app/mod_propinsi/cari_ajax', $data);

	}

	function cari_propinsi()
	{
		header("Content-Type: application/json");

		$cari = $this->input->get('term');
		$result = [];
		$data = $this->db->query("SELECT k.*
                                FROM tbl_propinsi k                                                          
                                WHERE k.status_propinsi = 'Y' 
								AND k.nama_propinsi like '%" . $cari . "%'								
								ORDER BY k.nama_propinsi ASC 
								LIMIT 100")->result();
		if (sizeof($data) > 0) {
			$result = $data;
		}

		echo json_encode($result);
	}
	
    function propinsi_tambah(){
        cek_session_admin();
		cek_session_cs();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit'])){
			$data = array('nama_propinsi' => $this->input->post('nama_propinsi')
						 );
			$this->model_app->insert('tbl_propinsi',$data);			
			redirect('master_propinsi/propinsi');
		}else{			
			$this->load->view('app/mod_propinsi/propinsi_tambah');
		}
    }
    
    function propinsi_edit(){
        cek_session_admin();
		cek_session_cs();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){		
            $data = array(
						  'nama_propinsi' => $this->input->post('nama_propinsi')
						 );
            $where = array('id_propinsi' => $this->input->post('id_propinsi'));
            $this->model_app->update('tbl_propinsi', $data, $where);
            redirect('master_propinsi/propinsi');
	        
		}else{
			$qry  = $this->model_app->edit('tbl_propinsi', array('id_propinsi' => $id))->row_array();
			$data = array('propinsi' => $qry);			
			$this->load->view('app/mod_propinsi/propinsi_edit',$data);
		}
    }
    
    function propinsi_hapus(){
		$id    = $this->input->post('id_propinsi');
		$where = array('id_propinsi' => $id);
		$data  = array('status_propinsi' => 'N');
		$this->model_app->update('tbl_propinsi', $data, $where);	
	}

	
}