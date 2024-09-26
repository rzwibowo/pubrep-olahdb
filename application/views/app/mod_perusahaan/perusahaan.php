<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include(APPPATH.'views/app/main-head.php'); ?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">           
            <?php include(APPPATH.'views/app/main-menu.php'); ?>

            <div class="content">
                <?php include(APPPATH.'views/app/main-navbar.php'); ?>

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Data Perusahaan</h5>
                            </div>
                           
                        </div>
                    </div>



                    <div class="card-body bg-light">

                        <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table class="table table-striped table-hover table-sm border-bottom" 
                                   style="font-size: 12px; font-weight:bold">
                                <thead >
                                    <tr class="bg-primary text-white">
                                        <th class="sort pr-1 align-middle">No</th>
                                        <th class="sort pr-1 align-middle">Logo</th>
                                        <th class="sort pr-1 align-middle">Perusahaan</th>
                                        <th class="sort pr-1 align-middle">NPWP</th>
                                        <th class="sort pr-1 align-middle text-left">Alamat</th>
                                        <th class="sort pr-1 align-middle text-left">Telp</th>
                                        <th class="sort pr-1 align-middle text-left">Action</th>
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
        function cari_ajax() {
            document.getElementById("data_body").innerHTML = "";
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('master_perusahaan/cari_ajax'); ?>",
                cache: false,
                success: function(html) {
                    document.getElementById("data_body").innerHTML = html;
                }
            })
        }

        $(document).ready(function() {
            cari_ajax();
        })
    </script>


</body>

</html>