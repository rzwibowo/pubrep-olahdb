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
                                <h5 class="mb-2 mb-md-0">Upload Database Customer</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <!-- <h5 class="mb-0">Data Operator</h5> -->
                    </div>
                    <div class="card-body bg-light">
                        <?php
                        $attributes = array('id' => 'csv-customer', 'class' => 'dropzone no-margin');
                        echo form_open_multipart('master_customer/upload_xl', $attributes);
                        ?>
                        <!-- <div class="dropzone no-margin" id="img-up"> -->
                        <div class="fallback">
                            <input name="csv_customer" type="file" />
                        </div>
                        <!-- </div> -->

                        </form>
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
                                <button type="button" name="submit_csv" class="btn btn-falcon-default btn-sm mr-2" id="btn-simpan">
                                    <span id="simpan-idle">Simpan</span>
                                    <span id="simpan-process" style="display: none;"><i class="fas fa-circle-notch fa-spin"></i></span>
                                </button>
                                <a href="<?php echo base_url() . "master_customer/customer"; ?>" class="btn btn-falcon-primary btn-sm">Batal</a>
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
        Dropzone.autoDiscover = false
        let img_up

        img_up = new Dropzone("#csv-customer", {
            addRemoveLinks: true,
            dictRemoveFile: '<i class="fas fa-times"></i>',
            autoProcessQueue: false,
            maxFiles: 1,
            maxfilesexceeded: function(file) {
                this.removeAllFiles()
                this.addFile(file)
            },
            acceptedFiles: ".xls, .xlsx"
        })

        img_up.on('success', function(_, res) {
            if (res.status === 'save-ok') {
                // alert('berhasil')
                toastr.info('Data berhasil disimpan')
                location.replace('<?php echo base_url() ?>master_customer/customer?rows_ins=' + res.rows_ins +
                    '&rows_upd=' + res.rows_upd +
                    '&rows_err=' + res.rows_err)
            } else {
                // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-err')
                toastr.error('Gagal impor data, cek lagi isi file Excel')
            }

            loading('stop')
        })

        img_up.on("error", function(file, errormessage, xhr) {
            toastr.error('Gagal impor data, cek lagi isi file Excel')
            loading('stop')
        })

        $('button[name=submit_csv]').on('click', function() {
            loading('start')

            if (img_up.files.length > 0) {
                img_up.processQueue()
            } else {
                alert('File Kosong')
                loading('stop')
            }
        })

        function loading(type) {
            if (type === 'start') {
                $('#simpan-idle').hide()
                $('#simpan-process').show()
                $('#btn-simpan').attr('disabled', true)
            } else {
                $('#simpan-idle').show()
                $('#simpan-process').hide()
                $('#btn-simpan').attr('disabled', false)
            }
        }
    </script>
</body>

</html>