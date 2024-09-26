<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include(APPPATH . 'views/app/main-head.php'); ?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            <?php include(APPPATH . 'views/app/main-menu.php'); ?>

            <div class="content">
                <?php include(APPPATH . 'views/app/main-navbar.php'); ?>



                <div class="card mb-3">
                    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-2.png);">
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">
                                <h5 class="mb-2 mb-md-0">Customer Error Log</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <!-- <h5 class="mb-0">Data Operator</h5> -->
                    </div>
                    <div class="card-body bg-light">
                        <div class="table-responsive">
                            <table class="table table-sm" style="font-size: 12px; font-weight:bold">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Tanggal Impor</th>
                                        <th>Detail Error</th>
                                        <th>Keterangan Error</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($log as $l) { ?>
                                        <tr>
                                            <td><?php echo $l->tgl_impor ?></td>
                                            <td><?php echo $l->detail_error ?></td>
                                            <td><?php echo $l->pesan_error ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-3.png);">
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">

                            </div>
                            <div class="col-auto">
                                <a href="<?php echo base_url() . "master_customer/export_error_log"; ?>" class="btn btn-falcon-primary btn-sm">Get Excel</a>
                                <button class="btn btn-falcon-primary btn-sm" onclick="hapus_data()">Clear Log</button>
                                <a href="<?php echo base_url() . "master_customer/customer"; ?>" class="btn btn-falcon-primary btn-sm">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>



                <?php include(APPPATH . 'views/app/main-footer.php'); ?>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include(APPPATH . 'views/app/main-js.php'); ?>
    <script>
        function hapus_data() {
            swal({
                title: 'Bersihkan Error Log',
                text: "Apakah semua error di file Excel sudah diperbaiki?",
                icon: 'warning',
                buttons: true
            }).then(function(value) {
                if (value) {
                    location.replace('<?php echo base_url() ?>master_customer/clear_error_log');
                }
            })
        }
    </script>
</body>

</html>