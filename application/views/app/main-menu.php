<nav class="navbar navbar-vertical navbar-expand-xl navbar-light">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div><a class="navbar-brand" href="<?php echo base_url() ?>app/home">
            <div class="d-flex align-items-center py-3"><img class="mr-2" src="<?php echo base_url(); ?>/assets/img/illustrations/golden.png" alt="" height="30" />
                <span class="text-sans-serif" style="font-size:20px">Bos CRM Clicco</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-glass perfect-scrollbar scrollbar" id="navbarVerticalCollapse">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>app/home">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text">Dashboard</span>
                    </div>
                </a>
            </li>


            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="master">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-copy"></span></span><span class="nav-link-text">Master Data</span>
                    </div>
                </a>
                <ul class="nav collapse" id="master">
                    <?php if ($this->session->id_level == '1') { ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_perusahaan/perusahaan">Perusahaan</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_lokasi/lokasi">Lokasi</a>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#operator" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="operator">Operator</a>
                            <ul class="nav collapse" id="operator">
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_level/level">Level Akses</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_operator/operator">Operator</a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#olshop" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="olshop">Online Shop</a>
                        <ul class="nav collapse" id="olshop">
                            <li class="nav-item"><a class="nav-link" href="pages/errors/404.html">Online Shop</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="pages/errors/500.html">Karyawan Olshop</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_customer/customer">Customer</a>
                            </li>
                        </ul>
                    </li>

                    <?php if ($this->session->id_level != '3') { ?>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pendukung" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pendukung">Pendukung</a>
                            <ul class="nav collapse" id="pendukung">
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_segmentasi/segmentasi">Segmentasi</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_alasan/alasan">Alasan</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_propinsi/propinsi">Propinsi</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_kota/kota">Kota/Kabupaten</a>
                                </li>

                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#transaksi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="transaksi">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cart-plus"></span></span><span class="nav-link-text">Transaksi</span>
                    </div>
                </a>
                <ul class="nav collapse" id="transaksi">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>transaksi_penawaran/penawaran">Penawaran</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Pendapatan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Biaya</a>
                    </li>
                </ul>
            </li>



            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#rekap" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="rekap">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book-open"></span></span><span class="nav-link-text">Rekap
                            Transaksi</span>
                    </div>
                </a>
                <ul class="nav collapse" id="rekap">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>rekap_penawaran/penawaran_rekap">Penawaran</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Pendapatan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Biaya</a>
                    </li>
                </ul>

            </li>

            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#laporan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="laporan">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-bar"></span></span><span class="nav-link-text">Laporan</span>
                    </div>
                </a>
                <ul class="nav collapse" id="laporan">
                    <li class="nav-item"><a class="nav-link" href="#">Penawaran</a>
                    </li>
                </ul>
                <ul class="nav collapse" id="laporan">
                    <li class="nav-item"><a class="nav-link" href="#">Cash
                            Flow</a>
                    </li>
                </ul>

            </li>

            <?php if ($this->session->id_level != '3') { ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>master_customer/customer_import">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-address-book"></span></span><span class="nav-link-text">Import
                                Customer</span>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>


        <div class="settings px-3 px-xl-0">
            <div class="navbar-vertical-divider">
                <hr class="border-300 my-3" />
            </div><a class="btn btn-primary btn-sm btn-block my-3 btn-purchase" href="<?php echo base_url(); ?>transaksi_penawaran/penawaran">
                Penawaran</a>
        </div>
    </div>
</nav>