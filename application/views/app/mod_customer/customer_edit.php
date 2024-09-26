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

                <?php
                // $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                // echo form_open_multipart('master_operator/operator_tambah', $attributes);
                ?>

                <div class="card mb-3">
                    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-2.png);">
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">
                                <h5 class="mb-2 mb-md-0">Edit Customer</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $attributes = array('id' => 'form-customer');
                echo form_open("master_customer/customer_edit", $attributes);
                echo "<input type='hidden' name='id_customer' value='$customer[id_customer]'>";

                ?>
                <div class="row no-gutters">
                    <div class="col-lg-6 pr-lg-2">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Data Customer</h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nama_customer">Nama</label>
                                            <input class="form-control" id="nama_customer" name="nama_customer" type="text" placeholder="Username" value="<?php echo $customer['nama_customer'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp_customer">Telp</label>
                                            <input class="form-control" id="telp_customer" name="telp_customer" type="text" placeholder="Telepon" value="<?php echo $customer['telp_customer'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_customer">Alamat</label>
                                            <input class="form-control" id="alamat_customer" name="alamat_customer" type="text" placeholder="Alamat" value="<?php echo $customer['alamat_customer'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kodepos">Kode Pos</label>
                                            <input class="form-control" id="kodepos" name="kodepos" type="text" placeholder="Kode Pos" value="<?php echo $customer['kodepos'] ?>" required>
                                        </div>
                                        <?php if ($customer['error_kota_customer'] == 'Y') { ?>
                                            <div class="alert alert-warning" role="alert">
                                                Nama kota tidak ditemukan di database
                                            </div>
                                            <div class="form-group">
                                                <label for="kota_csv">Kota di CSV</label>
                                                <input class="form-control" id="kota_csv" name="kota_csv" type="text" placeholder="Kota" value="<?php echo $customer['kota_csv_customer'] ?>" readonly>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="nama_level">Propinsi</label>
                                            <select class="form-control" id="id_propinsi" name="id_propinsi" required>
                                                <?php
                                                foreach ($propinsi as $rows) {
                                                    echo "<option value=\"" . $rows['id_propinsi'] . "\" ";
                                                    if ($rows['id_propinsi'] == $customer['id_propinsi']) echo 'selected';
                                                    echo ">" . $rows['nama_propinsi'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_level">Kota</label>
                                            <select class="form-control" id="id_kota" name="id_kota" required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <button type="submit" name="submit_customer" class="btn btn-falcon-default btn-sm mr-2">Simpan</button>
                                <a href="<?php echo base_url() . "master_customer/customer"; ?>" class="btn btn-falcon-primary btn-sm">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>


                </form>

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
        $(document).ready(async function() {
            await getKota()

            $('#id_kota').val('<?php echo $customer['id_kabupaten'] ?>')
        })

        async function getKota() {
            $('#id_kota').html('')

            const datapropinsi = "id_propinsi=" + $('#id_propinsi').val();
            let options = ''
            await $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>master_kota/kota_by_propinsi",
                data: datapropinsi,
                success: function(data) {
                    data.forEach(element => {
                        options += `<option value="${element.id_kota}">${element.nama_kota}</option>`
                    });

                    $('#id_kota').html(options)
                }
            });
        }

        $('#id_propinsi').change(function() {
            getKota()
        })
    </script>
</body>

</html>