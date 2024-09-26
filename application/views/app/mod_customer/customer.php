<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include(APPPATH . 'views/app/main-head.php'); ?>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            <?php include(APPPATH . 'views/app/main-head.php'); ?>
            <?php include(APPPATH . 'views/app/main-menu.php'); ?>

            <div class="content">
                <?php include(APPPATH . 'views/app/main-navbar.php'); ?>

                <div class="card mb-3">
                    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?php echo base_url(); ?>/assets/img/illustrations/corner-3.png);">
                    </div>
                    <!--/.bg-holder-->

                    <div class="card-header">
                        <h5 class="mb-0"> Data Customer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <?php if ($cari != '') { ?>
                                        <div class="input-group-prepend">
                                            <a href="<?php echo base_url() ?>master_customer/customer" class="btn btn-secondary" type="button">Kembali</a>
                                        </div>
                                    <?php } ?>
                                    <input type="search" class="form-control" placeholder="Cari Nama Customer..." aria-label="" aria-describedby="basic-addon1" value="<?php if ($cari != '') echo $cari ?>" id="cari">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="btn-cari">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="card mb-3">
                    <!-- <div class="card-header">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-6 col-sm-auto ml-auto text-right pl-0">

                                <div id="dashboard-actions">
                                    <a class="btn btn-falcon-default btn-sm" href='<?php echo base_url(); ?>master_customer/customer_tambah' type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ml-1">Tambah</span></a>
                                </div>
                            </div>
                        </div>
                    </div> -->



                    <div class="card-body bg-light">

                        <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table class="table table-striped table-hover table-sm border-bottom" id="main-table" style="font-size: 12px; font-weight:bold">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th></th>
                                        <th></th>
                                        <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                        <th class="sort pr-1 align-middle" style="width: 120px;">Nama</th>
                                        <th class="sort pr-1 align-middle" style="width: 140px;">Telp</th>
                                        <th class="sort pr-1 align-middle">Alamat</th>
                                        <th class="sort pr-1 align-middle">Kode Pos</th>
                                        <th class="sort pr-1 align-middle">Kota</th>
                                        <th class="sort pr-1 align-middle">Propinsi</th>
                                        <th class="sort pr-1 align-middle text-left" style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="data_body">
                                    <?php $i = 1;
                                    foreach ($customer as $c) { ?>
                                        <tr <?php if ($c->error_kota_customer == 'Y') echo 'class="table-warning"' ?>>
                                            <td></td>
                                            <td><?php echo $c->id_customer ?></td>
                                            <td><?php echo $cari != '' ? $i : $page * 100 + $i ?></td>
                                            <td><?php echo $c->nama_customer ?></td>
                                            <td><?php echo $c->telp_customer ?></td>
                                            <td><?php echo $c->alamat_customer ?></td>
                                            <td><?php echo $c->kodepos ?></td>
                                            <td><?php echo $c->nama_kota ?></td>
                                            <td><?php echo $c->nama_propinsi ?></td>
                                            <td class="text-right">
                                                <div class="btn-group btn-group-xs sm-m-t-10">
                                                    <a class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="<?php echo base_url() ?>master_customer/customer_edit/<?php echo $c->id_customer ?>">
                                                        <span class="fas fa-pen"></span>
                                                    </a>
                                                    <a class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="hapus_data(<?php echo $c->id_customer ?>, false)">
                                                        <span class="fas fa-trash-alt"></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-secondary" title="Pilih Semua" id="btn-pilih"><i class="far fa-check-square"></i></button>
                                    <button type="button" class="btn btn-secondary" title="Tidak Pilih Semua" id="btn-unpilih"><i class="far fa-square"></i></button>
                                </div>
                                <button type="button" class="btn btn-outline-danger" title="Hapus Terpilih" id="btn-hapuspilih"><i class="far fa-trash-alt"></i></button>
                            </div>
                            <div class="col-md-8 text-right">
                                <?php if ($cari == '') { ?>
                                    <span class="mr-3">
                                        <?php $total_page = floor($total / 100); ?>
                                        Data ke <?php echo $page * 100 + 1 ?> sampai <?php if ($page >= $total_page) {
                                                                                            echo $total;
                                                                                        } else {
                                                                                            echo ($page + 1) * 100;
                                                                                        } ?> dari total <?php echo $total ?> data
                                    </span>

                                    <button class="btn btn-outline-secondary" type="button" id="btn-prev-page" <?php if ($page == 0) echo 'disabled' ?>>
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <select id="select-page" class="form-control" style="width: 7em; display: inline-block;">
                                        <?php for ($i = 1; $i <= $total_page + 1; $i++) { ?>
                                            <option value="<?php echo $i - 1 ?>" <?php if ($page == $i - 1) echo "selected" ?>>
                                                <?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" id="btn-next-page" <?php if ($page == $total_page) echo 'disabled' ?>>
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <a href="<?php echo base_url() ?>master_customer/error_log" class="text-danger">Error log</a>
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

    <script type="text/javascript">
        let datatable = $('#main-table').DataTable({
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            },
            columnDefs: [{
                    searchable: false,
                    targets: [1, 2, -1]
                },
                {
                    orderable: false,
                    targets: -1
                },
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                {
                    visible: false,
                    targets: 1
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child',
                headerCheckbox: true
            },
        })

        <?php if (isset($_GET['rows_ins']) || isset($_GET['rows_upd']) || isset($_GET['rows_err'])) {
            echo 'toastr.info(`Berhasil mengimpor ' . $_GET['rows_ins'] .
                ' customer, update ' . $_GET['rows_upd'] . ' customer. ' .
                $_GET['rows_err'] . ' baris data bermasalah tidak diimpor. 
                Lihat data error di <a href="' . base_url() . 'master_customer/error_log">error log</a>.`, 
                "Informasi Impor", 
                {timeOut: 0, extendedTimeOut: 0});';
            echo 'history.replaceState({}, "", "customer")';
        } ?>

        const url = "<?php echo base_url() ?>master_customer/customer/";
        const page = <?php echo $page ?>;

        function gen_link_cari() {
            const cari = $('#cari').val().trim()
            let link = url
            if (cari.length > 0) {
                link = `${link}0/${encodeURIComponent(cari)}`
            }
            return link
        }

        function gen_link(page_num) {
            return `${url}${page_num}`
        }

        $('#btn-cari').click(function() {
            window.location.assign(gen_link_cari())
        })

        $('#cari').keypress(function(e) {
            if (e.which == 13) {
                window.location.assign(gen_link_cari())
            }
        });

        $('#select-page').change(function() {
            const page_selected = $('#select-page').val()
            window.location.assign(gen_link(page_selected))
        })

        $('#btn-prev-page').click(function() {
            const prev_page = page - 1
            window.location.assign(gen_link(prev_page))
        })

        $('#btn-next-page').click(function() {
            const next_page = page + 1
            window.location.assign(gen_link(next_page))
        })

        $('#btn-pilih').click(function() {
            datatable.rows().select();
        })

        $('#btn-unpilih').click(function() {
            datatable.rows().deselect();
        })

        $('#btn-hapuspilih').click(function() {
            if (datatable.rows({ selected: true }).data().length > 0) {
                const ids = datatable.rows({ selected: true }).data().map(e => e[1]).join(', ')
                hapus_data(ids, true)
            } else {
                toastr.error('Tidak ada data customer terpilih untuk dihapus.', 'Kesalahan')
            }
        })

        function hapus_data(id, isbatch) {
            swal("Masukan password otoritas untuk menghapus data", {
                    content: "input",
                })
                .then((value) => {
                    if (value != '') {
                        var dataString = "password_auth=" + value;
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>app/cek_authentifikasi",
                            data: dataString,
                            cache: false,
                            success: function(data) {
                                if (data == 'Y') {
                                    if (isbatch) {
                                        hapusbatch(id);
                                    } else {
                                        hapus(id);
                                    }
                                } else {
                                    swal("", "Password tidak ditemukan.", "info");
                                }
                            }
                        });
                    }
                });
        }

        function hapus(id) {
            var datahapus = "id_customer=" + id;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>master_customer/customer_hapus",
                data: datahapus,
                cache: false,
                success: function(data) {
                    var urltarget = "<?php echo base_url(); ?>master_customer/customer";
                    $(location).attr('href', urltarget);
                }
            });
        }

        function hapusbatch(ids) {
            var datahapus = "id_customers=" + ids;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>master_customer/customer_hapus_batch",
                data: datahapus,
                cache: false,
                success: function(data) {
                    var urltarget = "<?php echo base_url(); ?>master_customer/customer";
                    $(location).attr('href', urltarget);
                }
            });
        }
    </script>


</body>

</html>