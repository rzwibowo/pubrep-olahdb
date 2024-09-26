<?php
    $no = 1;
    $data_ajax = '';    
    $result = [];

    foreach ($operator->result_array() as $row){            
      $data_ajax =  $data_ajax."<tr>                                             
                                    <td>$no</td>
                                    <td>$row[nama_level]</td> 
                                    <td>$row[username_operator]</td>
                                    <td>$row[nama_operator]</td>
                                    <td>$row[telp_operator]</td>
                                    <td>$row[alamat_operator]</td>         
                                    <td>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Edit Data' 
                                            href='".base_url()."master_operator/operator_edit/$row[id_operator]'>
                                            <span class='fas fa-pen'></span>
                                        </a>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Hapus Data' 
                                            id=$row[id_operator]
                                            onclick='hapus_data($row[id_operator])'>
                                            <span class='fas fa-trash-alt'></span>
                                        </a>
                                    </td>
                                    
                                </tr>";
      $no++;
    }

    $result[] = $data_ajax;   
    echo json_encode($result); 
   
?>