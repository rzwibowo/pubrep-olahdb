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
                    echo form_open_multipart('master_perusahaan/perusahaan_edit',$attributes); 
                ?>
        <input type="hidden" name="id" value="<?php echo $perusahaan['id_perusahaan']; ?>" > 

        <div class="card mb-3">                      
                    <div class="card-body" >
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">
                                <h5 class="mb-2 mb-md-0">Edit Perusahaan</h5>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row no-gutters">                    
                    <div class="col-lg-8 pr-lg-2">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Data Perusahaan</h5>
                            </div>
                            
                            <div class="card-body bg-light">
                            
                                <div class="form-row">
                                    <div class="col-2">
                                        <div class="form-group">
                                           
                                        <img class="img-thumbnail img-fluid rounded-circle mb-3 shadow-sm" 
                                            src="<?php echo base_url()."upload/images/".$perusahaan['logo_perusahaan']; ?>" 
                                            alt="" width="100" />   
                                        </div>
                                    </div>
                                    
                                    <div class='col-10'>
                                        <div class='form-group'>
                                            <label for='nama_perusahaan'>Nama Perusahaan</label>
                                            <input class='form-control' id='nama_perusahaan' name='nama_perusahaan' type='text'
                                                placeholder='Nama Perusahaan'
                                                value = "<?php echo $perusahaan['nama_perusahaan']; ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <hr class="border-dashed border-bottom-0">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="npwp_perusahaan">NPWP</label>
                                            <input class="form-control" id="npwp_perusahaan" name="npwp_perusahaan" type="text"
                                                placeholder="NPWP"
                                                value = "<?php echo $perusahaan['npwp_perusahaan']; ?>" > 
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telp_perusahaan">Telp</label>
                                            <input class="form-control" id="telp_perusahaan" name="telp_perusahaan" type="text"
                                                placeholder="Telp"
                                                value = "<?php echo $perusahaan['telp_perusahaan']; ?>" >  
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat_perusahaan">Alamat</label>
                                            <input class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" type="text"
                                                placeholder="Alamat Perusahaan"
                                                value = "<?php echo $perusahaan['alamat_perusahaan']; ?>" > 
                                          
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 pl-lg-2">
                        <div class="sticky-top sticky-sidebar">
                            <div class="card mb-3 mb-lg-0" style="height:404px">
                                <div class="card-header">
                                    <h5 class="mb-0">Upload Logo</h5>
                                </div>
                                <div class="card-body bg-light">
                                    <div class="dropzone dropzone-single p-0" data-dropzone
                                        data-options='{"url":"valid/url","maxFiles":1,"dictDefaultMessage":"Choose or Drop a file here"}'>
                                        <div class="fallback">
                                            <input type="file" name="logo" id="logo">
                                        </div>
                                        <div class="dz-preview dz-preview-single">
                                            <div class="dz-preview-cover dz-complete"><img class="dz-preview-img" src="..."
                                                    alt="..." data-dz-thumbnail=""><a class="dz-remove text-danger"
                                                    href="#!" data-dz-remove><span class="fas fa-times"></span></a>
                                                <div class="dz-progress"><span class="dz-upload"
                                                        data-dz-uploadprogress=""></span></div>
                                            </div>
                                        </div>
                                        <div style="height:300px" class="dz-message" data-dz-message>
                                            <div class="dz-message-text"><img class="mr-2"
                                                    src=" assets/img/icons/cloud-upload.svg" width="25" alt="">Pilih gambar disini</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                

                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md">
                                
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="submit" class="btn btn-falcon-default btn-sm mr-2">Simpan</button>
                                <a 
                                    href  = "<?php echo base_url()."master_perusahaan/perusahaan"; ?>"
                                    class = "btn btn-falcon-primary btn-sm">Batal</a>                                
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