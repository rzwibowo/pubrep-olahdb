<?php
    $no = 1;
    $data_ajax = '';    
    $result = [];

    foreach ($propinsi->result_array() as $row){            
      $data_ajax =  $data_ajax."<tr>                                             
                                    <td>$no</td>
                                    <td>$row[nama_propinsi]</td>         
                                    <td>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Edit Data' 
                                            href='".base_url()."master_propinsi/propinsi_edit/$row[id_propinsi]'>
                                            <span class='fas fa-pen'></span>
                                        </a>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Hapus Data' 
                                            id=$row[id_propinsi]
                                            onclick='hapus_data($row[id_propinsi])'>
                                            <span class='fas fa-trash-alt'></span>
                                        </a>
                                    </td>
                                    
                                </tr>";
      $no++;
    }

    $result[] = $data_ajax;   
    echo json_encode($result); 
   
?>