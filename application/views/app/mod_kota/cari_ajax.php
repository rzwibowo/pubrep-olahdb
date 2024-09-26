<?php
    $no = 1;
    $data_ajax = '';    
    $result = [];

    foreach ($kota->result_array() as $row){            
      $data_ajax =  $data_ajax."<tr>                                             
                                    <td>$no</td>
                                    <td>$row[nama_propinsi]</td> 
                                    <td>$row[nama_kota]</td>         
                                    <td>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Edit Data' 
                                            href='".base_url()."master_kota/kota_edit/$row[id_kota]'>
                                            <span class='fas fa-pen'></span>
                                        </a>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Hapus Data' 
                                            id=$row[id_kota]
                                            onclick='hapus_data($row[id_kota])'>
                                            <span class='fas fa-trash-alt'></span>
                                        </a>
                                    </td>
                                    
                                </tr>";
      $no++;
    }

    $result[] = $data_ajax;   
    echo json_encode($result); 
   
?>