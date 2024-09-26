<?php
    $no = 1;
    foreach ($perusahaan->result_array() as $row){          
      echo  "<tr class='btn-reveal-trigger'>
                <td class = 'align-middle'>$no</td>             
                <td class = 'align-middle' style = 'width:140px'>                 
                  <img class='img-thumbnail img-fluid rounded-circle mb-3 shadow-sm' 
                        src='".base_url()."upload/images/$row[logo_perusahaan]' alt='' width='100' />                  
                </td>
                <td class = 'align-middle'>$row[nama_perusahaan]</td>
                <td class = 'align-middle'>$row[npwp_perusahaan]</td>
                <td class = 'align-middle'>$row[alamat_perusahaan]</td>
                <td class = 'align-middle'>$row[telp_perusahaan]</td>
                <td class = 'align-middle'>
                  <a class = 'btn btn-falcon-default btn-sm '
                    data-toggle='tooltip' data-placement='top' title='Edit Data'
                    href='".base_url()."master_perusahaan/perusahaan_edit/$row[id_perusahaan]'>
                    <span class='fas fa-edit'></span>
                  </a>  
               
                </td>
            </tr>";
      $no++;
    }   
?>