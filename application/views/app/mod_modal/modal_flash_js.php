<?php
    if($flash_msg=$this->session->flashdata('flash_msg')) {
        echo '<script type="text/javascript">
                $("#modal-flash").modal("show");
            </script>';   
    }   
?>