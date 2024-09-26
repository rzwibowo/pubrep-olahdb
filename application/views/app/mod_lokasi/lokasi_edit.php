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

                <?php
                    $attributes = array('class'=>'form-horizontal','role'=>'form');
                    echo form_open_multipart('master_lokasi/lokasi_edit',$attributes); 
                    
                ?>
                <div class="card mb-3">
                    <div class="bg-holder d-none d-lg-block bg-card"
                        style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-2.png);">
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">
                                <h5 class="mb-2 mb-md-0">Edit lokasi</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <?php echo "<input type='hidden' name='id_lokasi' value='$lokasi[id_lokasi]'>"; ?>
                    <div class="card-body bg-light">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_perusahaan">Perusahaan</label>
                                    <select class="form-control" id="id_perusahaan" name="id_perusahaan">
                                        <?php
                                        foreach ($perusahaan as $rows) {
                                            if ($rows['id_perusahaan']==$lokasi['id_perusahaan']){
                                              echo "<option value='$rows[id_perusahaan]' selected>$rows[nama_perusahaan]</option>";
                                            }else{
                                              echo "<option value='$rows[id_perusahaan]'>$rows[nama_perusahaan]</option>";
                                            }                                                                                     
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_lokasi">Nama Lokasi</label>
                                    <input class="form-control" id="nama_lokasi" name="nama_lokasi" type="text"
                                        placeholder="Nama Lokasi"
                                        value='<?php echo $lokasi['nama_lokasi']; ?>'>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="bg-holder d-none d-lg-block bg-card"
                        style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-3.png);">
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">

                            </div>
                            <div class="col-auto">
                                <button type="submit" name="submit"
                                    class="btn btn-falcon-default btn-sm mr-2">Simpan</button>
                                <a href="<?php echo base_url()."master_lokasi/lokasi"; ?>"
                                    class="btn btn-falcon-primary btn-sm">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>


                </form>

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

</body>

</html>