<?php
    $no = 1;
    $data_ajax = '';    
    $result = [];

    foreach ($level->result_array() as $row){            
        $data_ajax =  $data_ajax."<tr>                                             
                                    <td>$no</td>
                                    <td>$row[nama_level]</td>        
                                    <td>
                                        <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Edit Data' 
                                            href='".base_url()."master_level/level_edit/$row[id_level]'>
                                            <span class='fas fa-pen'></span>
                                        </a>";
        
        if ($row['id_level'] > 1){
            $data_ajax =  $data_ajax."  <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Level Akses' 
                                            id=$row[id_level]
                                            onclick='level_akses($row[id_level])'>
                                            <span class='fas fa-cog'></span>
                                        </a>"; 

            $data_ajax =  $data_ajax."  <a class='btn btn-light' 
                                            data-toggle='tooltip'
                                            data-placement='top'
                                            title='Hapus Data' 
                                            id=$row[id_level]
                                            onclick='hapus_data($row[id_level])'>
                                            <span class='fas fa-trash-alt'></span>
                                        </a>";  
        }
                                        
        $data_ajax =  $data_ajax."  </td>
                                    
                                </tr>";
      $no++;
    }

    $result[] = $data_ajax;   
    echo json_encode($result); 
   
?>