<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Browse extends CI_Controller {
    
    function browse_customer(){
		$data['customer'] = $this->db->query("SELECT * FROM tbl_customer
                                            where status_customer = 'Y'                                           
                                            ORDER BY id_customer ASC")->result_array(); 
        $this->load->view('app/mod_browse/browse_customer', $data); 
    }
    
}