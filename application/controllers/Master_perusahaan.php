<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_perusahaan extends CI_Controller {	
	function perusahaan(){
		cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$data = $this->model_app->view_where_asc('tbl_perusahaan',array('status_perusahaan' => 'Y'),'id_perusahaan');
        $data = array('record' => $data);
        $this->load->view('app/mod_perusahaan/perusahaan',$data);
    }

    function cari_ajax(){
        $data = $this->db->query("SELECT * from tbl_perusahaan where status_perusahaan = 'Y' ");
        $data = array('perusahaan' => $data);        
        $this->load->view('app/mod_perusahaan/cari_ajax',$data);
    } 
    
    function perusahaan_edit(){
        cek_session_admin();
		cek_session_admin_data();
		cek_session_cs();
		$id = $this->uri->segment(3);

		if (isset($_POST['submit'])){			
			$config['upload_path'] = 'upload/images/';
	        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
	        $config['max_size'] = '10000'; // kb
	        $this->load->library('upload', $config);
			
			$this->upload->do_upload('logo');
			
	        $hasil=$this->upload->data();

			echo $hasil['file_name']; exit();

	        if ($hasil['file_name']==''){ 
                //tidak ada logo
	        	$data = array('nama_perusahaan' => $this->input->post('nama_perusahaan'),
						  'npwp_perusahaan' => $this->input->post('npwp_perusahaan'),
						  'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),						  
						  'telp_perusahaan' => $this->input->post('telp_perusahaan'));
				$where = array('id_perusahaan' => $this->input->post('id'));
				$this->model_app->update('tbl_perusahaan', $data, $where);
				redirect('master_perusahaan/perusahaan');
	        }else{
	        	//ada logo
	        	$data = array('nama_perusahaan' => $this->input->post('nama_perusahaan'),
						  'npwp_perusahaan' => $this->input->post('npwp_perusahaan'),
						  'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
						  'telp_perusahaan' => $this->input->post('telp_perusahaan'),
						  'logo_perusahaan' => $hasil['file_name']);

				$where = array('id_perusahaan' => $this->input->post('id'));
				$this->model_app->update('tbl_perusahaan', $data, $where);
				redirect('master_perusahaan/perusahaan');	
	        } 
		}else{
			$proses = $this->model_app->edit('tbl_perusahaan', array('id_perusahaan' => $id))->row_array();
			$data = array('perusahaan' => $proses);
			$this->load->view('app/mod_perusahaan/perusahaan_edit',$data);
		}
    }
}