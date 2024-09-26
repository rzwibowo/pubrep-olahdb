<?php 
class Model_app extends CI_model{
    function cek_login($username,$password){
        return $this->db->query("SELECT *  
                                 FROM tbl_operator
                                 WHERE username_operator='".$this->db->escape_str($username)."' 
                                 AND password_operator='".$this->db->escape_str($password)."' 
                                 AND status_operator = 'Y' ");
    }

    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
        
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }
    
    
    public function view_where_desc($table,$data,$order){
        $this->db->where($data);
        $this->db->order_by($order,"DESC");
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_where_asc($table,$data,$order){
        $this->db->where($data);
        $this->db->order_by($order,"ASC");
        $query = $this->db->get($table);
        return $query->result_array();
    }    
}