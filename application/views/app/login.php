<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php include 'main-head.php'; ?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center no-gutters">
                <div class="col-lg-8 col-xxl-5 py-3"><img class="bg-auth-circle-shape" src="<?php echo base_url(); ?>/assets/img/illustrations/bg-shape.png" alt="" width="250"><img class="bg-auth-circle-shape-2" src="<?php echo base_url(); ?>/assets/img/illustrations/shape-1.png" alt="" width="150">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row no-gutters h-100">
                                <div class="col-md-5 text-white text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7">
                                        <div class="bg-holder bg-auth-card-shape" style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/half-circle.png);">
                                        </div>

                                        <div class="z-index-1 position-relative">
                                            <a class="text-white mb-4 text-sans-serif font-weight-extra-bold fs-4 d-inline-block">
                                                OLAH DB
                                            </a>
                                            <p class="text-white opacity-75">
                                                Saatnya beralih ke pengolahan database online. Akurat dan Realtime Data untuk pengembangan bisnis anda.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <h3>Account Login</h3>
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label for="card-email">Username</label>
                                                <input class="form-control" id="username_operator" type="text" name="username_operator" required />
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="card-password">Password</label>
                                                </div>
                                                <input class="form-control" id="password_operator" type="password" name="password_operator" required />
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Log in</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-pesan" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
            <div class="modal-dialog mt-6" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header px-5 text-white position-relative modal-shape-header">
                        <div class="position-relative z-index-1">
                            <div>
                                <h4 class="mb-0 text-white" id="authentication-modal-label">Retail Studio</h4>
                                <p class="fs--1 mb-0">
                                    Username atau password tidak ditemukan
                                </p>
                            </div>
                        </div>
                        <button class="close text-white position-absolute t-0 r-0 mt-1 mr-1" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include 'main-js.php'; ?>

    <?php
    if ($flash_msg = $this->session->flashdata('flash_msg')) {
        echo '<script type="text/javascript">
                  $("#modal-pesan").modal("show");
                </script>';
    }

    ?>


</body>

</html>