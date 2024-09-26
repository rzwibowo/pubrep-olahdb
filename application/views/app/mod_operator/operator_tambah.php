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
                                <h5 class="mb-2 mb-md-0">Tambah Operator</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $attributes = array('id' => 'form-operator');
                echo form_open("master_operator/operator_simpan", $attributes);
                ?>
                <div class="row no-gutters">
                    <div class="col-lg-6 pr-lg-2">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Data Operator</h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nama_level">Level</label>
                                            <select class="form-control" id="id_level" name="id_level">
                                                <?php
                                                foreach ($level as $rows) {
                                                    echo "<option value='".$rows['id_level']."'";
                                                    if ($this->session->flashdata('data') != null) {
                                                        if ($this->session->flashdata('data')['id_level'] == $rows['id_level']) {
                                                            echo " selected";
                                                        }
                                                    } 
                                                    echo ">$rows[nama_level]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username_operator">Username</label>
                                            <input class="form-control" id="username_operator" 
                                                name="username_operator" type="text" 
                                                placeholder="Username" required
                                                value="<?php if ($this->session->flashdata('data') != null) echo $this->session->flashdata('data')['username_operator'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username_operator">Password</label>
                                            <input class="form-control" id="password_operator" 
                                                name="password_operator" type="password" 
                                                placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username_operator">Nama</label>
                                            <input class="form-control" id="nama_operator" 
                                                name="nama_operator" type="text" 
                                                placeholder="Nama" required
                                                value="<?php if ($this->session->flashdata('data') != null) echo $this->session->flashdata('data')['nama_operator'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username_operator">Telp</label>
                                            <input class="form-control" id="telp_operator" 
                                                name="telp_operator" type="text" 
                                                placeholder="Telepon"
                                                value="<?php if ($this->session->flashdata('data') != null) echo $this->session->flashdata('data')['telp_operator'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username_operator">Alamat</label>
                                            <input class="form-control" id="alamat_operator" 
                                                name="alamat_operator" type="text" 
                                                placeholder="Alamat" 
                                                value="<?php if ($this->session->flashdata('data') != null) echo $this->session->flashdata('data')['alamat_operator'] ?>">
                                        </div>
                                        <input type="hidden" id="foto_operator" name="foto_operator">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-lg-2">
                        <div class="card mb-3 mb-lg-0" style="height:404px">
                            <div class="card-header">
                                <h5 class="mb-0">Upload Foto</h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="dropzone no-margin" id="img-up">
                                    <div class="fallback">
                                        <input name="gambar" type="file" />
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
                                <button type="submit" name="submit_operator" class="btn btn-falcon-default btn-sm mr-2">Simpan</button>
                                <a href="<?php echo base_url() . "master_operator/operator"; ?>" class="btn btn-falcon-primary btn-sm">Batal</a>
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
        let notif = ''
        <?php if ($this->session->flashdata('notifikasi') != null) echo "notif='" . $this->session->flashdata('notifikasi') . "';" ?>

        switch (notif) {
            case 'uname-err':
                toastr.error('Username sudah ada')
                break

            default:
                break
        }

        Dropzone.autoDiscover = false
        let img_up

        img_up = new Dropzone("div#img-up", {
            url: "<?php echo base_url() ?>master_operator/foto_simpan",
            addRemoveLinks: true,
            dictRemoveFile: '<i class="fas fa-times"></i>',
            autoProcessQueue: false,
            maxFiles: 1,
            maxfilesexceeded: function(file) {
                this.removeAllFiles()
                this.addFile(file)
            },
            acceptedFiles: ".jpeg,.jpg,.png"
        })

        img_up.on('success', function(_, res) {
            if (res.status === 'save-ok') {
                // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-ok')

                $('#foto_operator').val(res.filename)
                $('#form-operator')[0].submit()
            } else {
                // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-err')
                alert('Gagal')
            }
        })

        $('#form-operator').on('submit', function(e) {
            e.preventDefault()
            if (img_up.files.length > 0) {
                img_up.processQueue()
            } else {
                $('#form-operator')[0].submit()
            }
        })
    </script>
</body>

</html>