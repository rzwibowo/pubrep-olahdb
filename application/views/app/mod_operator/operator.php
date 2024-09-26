<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include(APPPATH.'views/app/main-head.php'); ?>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            <?php include(APPPATH.'views/app/main-head.php'); ?>
            <?php include(APPPATH.'views/app/main-menu.php'); ?>

            <div class="content">
                <?php include(APPPATH.'views/app/main-navbar.php'); ?>

                <div class="card mb-3">
                    
                    <div class="card-header">
                        <h5 class="mb-0"> Data Operator</h5>
                    </div>
                    <div class="bg-holder d-none d-lg-block bg-card"
                        style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-3.png);">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <h4 class="mb-0"></h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text"
                                            id="basic-addon1">Pencarian</span></div>
                                    <input class="form-control" type="text" placeholder="..." aria-label="Username"
                                        aria-describedby="basic-addon1" id="edtcari" name="edtcari">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary mr-1 mb-1" type="button" style="width:100%" id="btncari"
                                    name="btncari">Cari
                                </button>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-6 col-sm-auto ml-auto text-right pl-0">

                                <div id="dashboard-actions">
                                    <a class="btn btn-falcon-default btn-sm"
                                        href='<?php echo base_url(); ?>master_operator/operator_tambah' type="button"><span
                                            class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                            class="d-none d-sm-inline-block ml-1">Tambah</span></a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-body bg-light">

                        <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table class="table table-striped table-hover table-sm border-bottom"
                                style="font-size: 12px; font-weight:bold">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                        <th class="sort pr-1 align-middle" style="width: 120px;">Level</th>
                                        <th class="sort pr-1 align-middle" style="width: 140px;">Username</th>
                                        <th class="sort pr-1 align-middle" style="width: 140px;">Nama</th>
                                        <th class="sort pr-1 align-middle" style="width: 120px;">Telp</th>
                                        <th class="sort pr-1 align-middle">Alamat</th>
                                        <th class="sort pr-1 align-middle text-left" style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="data_body">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <?php include(APPPATH.'views/app/main-footer.php'); ?>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include(APPPATH.'views/app/main-js.php'); ?>

    <script type="text/javascript">
    function hapus_data(id){
      swal("Masukan password otoritas untuk menghapus data", {
          content: "input",
        })
        .then((value) => {
          if (value != ''){
            var dataString =  "password_auth=" + value ;
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>app/cek_authentifikasi",
              data: dataString,
              cache: false,
              success: function(data)
              {       
                if (data=='Y'){
                  hapus(id);
                } else {
                  swal("", "Password tidak ditemukan.", "info");
                }
              }
            });
          }
      });
    }

    function hapus(id){
      var datahapus =  "id_operator=" + id ;
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>master_operator/operator_hapus",
        data: datahapus,
        cache: false,
        success: function(data)
        {                   
          var urltarget = "<?php echo base_url();?>master_operator/operator";    
          $(location).attr('href',urltarget); 
        } 
      });
    }

    function cari_ajax() {
        var cari = document.getElementById('edtcari').value;
        var datasend = "cari=" + cari;
        document.getElementById("data_body").innerHTML = "";
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('master_operator/cari_ajax'); ?>",
            data: datasend,
            dataType: 'json',
            success: function(data) {
                document.getElementById("data_body").innerHTML = data;
            }
        })
    }

    $(document).ready(function() {
        cari_ajax();

        $('#btncari').click(function() {
            cari_ajax();
        });

        $('#edtcari').keypress(function (e) {
            if (e.which == 13) {
                cari_ajax();
            }
        });
    })
    </script>


</body>

</html>