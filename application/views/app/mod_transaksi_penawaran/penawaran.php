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
                        <h5 class="mb-0"> Penawaran Customer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="rentang-tanggal" class="col-sm-4 col-form-label text-right">Rentang Tgl. Beli</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rentang-tanggal" placeholder="Tanggal Pembelian">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="kota" class="col-sm-4 col-form-label text-right">Kota</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="kota"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="cari" class="col-sm-4 col-form-label text-right">Aktivitas Follow Up</label>
                                    <div class="col-sm-8">
                                        <select name="aktivitas_follow_up" id="aktivitas_follow_up" class="form-control">
                                            <option value="0" selected>Semua</option>
                                            <option value="prospek">Prospek</option>
                                            <option value="negosiasi">Negosiasi</option>
                                            <option value="closing">Closing</option>
                                            <option value="dihentikan">Dihentikan</option>
                                            <option value="terbuka">Terbuka</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="operator" class="col-sm-4 col-form-label text-right">Operator</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="select-operator">
                                            <option value="0">Semua</option>
                                            <?php foreach ($operator as $o) { ?>
                                                <option value="<?php echo $o['id_operator'] ?>"><?php echo $o['nama_operator'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="cari" class="col-sm-4 col-form-label text-right">Customer</label>
                                    <div class="col-sm-8">
                                        <input type="search" class="form-control" id="cari" placeholder="Cari Nama/No. Telp Customer...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-secondary mr-1 mb-1" type="button" id="btnxl" name="btnxl" onclick="cetak_xl()">Excel</button>
                                <button class="btn btn-primary mr-1 mb-1" type="button" id="btncari" name="btncari">Cari
                                </button>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-11">
                                <h4 class="mb-0"></h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Pencarian</span></div>
                                    <input class="form-control" type="text" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" id="edtcari" name="edtcari">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary mr-1 mb-1" type="button" style="width:100%" id="btncari" name="btncari">Cari
                                </button>
                            </div>
                        </div> -->
                    </div>

                </div>



                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-6 col-sm-auto ml-auto text-right pl-0">

                                <div id="dashboard-actions">
                                    <!-- <a class="btn btn-falcon-default btn-sm" href='<?php echo base_url(); ?>master_customer/customer_tambah' type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ml-1">Tambah</span></a> -->
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-body bg-light">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-striped table-hover table-sm border-bottom" id="main-table" style="font-size: 12px; font-weight:bold">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                        <th class="sort pr-1 align-middle" style="width: 120px;">Nama</th>
                                        <th class="sort pr-1 align-middle" style="width: 140px;">Telp</th>
                                        <th class="sort pr-1 align-middle">Alamat</th>
                                        <th class="sort pr-1 align-middle">Kota</th>
                                        <th class="sort pr-1 align-middle">Propinsi</th>
                                        <th class="sort pr-1 align-middle">Aktivitas Follow Up</th>
                                        <th class="sort pr-1 align-middle">Tgl Penawaran</th>
                                        <th class="sort pr-1 align-middle">Nama Operator</th>
                                        <th class="sort pr-1 align-middle">Tgl Beli Terakhir</th>
                                        <th class="sort pr-1 align-middle">x Pembelian</th>
                                        <th class="sort pr-1 align-middle">Nama CS</th>
                                        <th class="sort pr-1 align-middle text-left" style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="data_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php include(APPPATH . 'views/app/main-footer.php'); ?>
            </div>
        </div>
    </main>

    <!-- <div class="modal fade" id="modal-penawaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <?php
            $attributes = array('id' => 'form-penawaran');
            echo form_open("transaksi_penawaran/penawaran_tambah_proses", $attributes);
            ?>
            <input type="hidden" id="id_customer" name="id_customer" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Penawaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nama_customer">Nama</label>
                                <input class="form-control" id="nama_customer" name="nama_customer" type="text" placeholder="Username" readonly>
                            </div>
                            <div class="form-group">
                                <label for="telp_customer">Cara Penawaran</label>
                                <select class="form-control" id="media_penawaran" name="media_penawaran" required>
                                    <option value="wa">WhatsApp</option>
                                    <option value="telp">Telepon</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_level">Segmentasi</label>
                                <select class="form-control" id="id_segmentasi" name="id_segmentasi" required>
                                    <?php
                                    //foreach ($segmentasi as $rows) {
                                    // echo "<option value='$rows[id_segmentasi]'>$rows[nama_segmentasi]</option>";
                                    //}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_level">Alasan</label>
                                <select class="form-control" id="id_alasan" name="id_alasan" required>
                                    <?php
                                    //foreach ($alasan as $rows) {
                                    //  echo "<option value='$rows[id_alasan]'>$rows[nama_alasan]</option>";
                                    //}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_level">Keterangan</label>
                                <textarea name="keterangan_penawaran" id="keterangan_penawaran" cols="30" rows="3" class="form-control" placeholder="Keterangan" maxlength="500"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama_level">Bukti Gambar</label>
                                <div class="dropzone no-margin" id="img-up">
                                    <div class="fallback">
                                        <input name="gambar" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp_customer">Kesimpulan</label>
                                <select class="form-control" id="kesimpulan_penawaran" name="kesimpulan_penawaran" required>
                                    <option value="potensial">Potensial</option>
                                    <option value="tidak potensial">Tidak Potensial</option>
                                    <option value="tidak diketahui">Tidak Diketahui</option>
                                    <option value="tidak respon">Tidak Direspon</option>
                                </select>
                            </div>
                            <input type="hidden" id="foto_penawaran" name="foto_penawaran">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div> -->

    <div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Pembelian</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                        <table class="table table-striped table-hover table-sm border-bottom" id="riwayat-table" style="font-size: 12px; font-weight:bold">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                    <th class="sort pr-1 align-middle">Tanggal</th>
                                    <th class="sort pr-1 align-middle">Ekspedisi</th>
                                    <th class="sort pr-1 align-middle">Item</th>
                                    <th class="sort pr-1 align-middle">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include(APPPATH . 'views/app/main-js.php'); ?>

    <script type="text/javascript">
        const rangeTgl = $('#rentang-tanggal').flatpickr({
            mode: 'range',
            dateFormat: 'd/m/Y',
            locale: 'id',
            // https://github.com/flatpickr/flatpickr/issues/1018#issuecomment-621639600
            // onChange: function(selectedDates, dateStr, instance) {
            //     if (selectedDates.length > 1) {
            //         var range = instance.formatDate(selectedDates[1], 'U') - instance.formatDate(selectedDates[0], 'U');
            //         range = range / 86400;

            //         if (range > 30) {
            //             alert("Maksimal rentang tanggal adalah 31 hari");
            //             instance.clear()
            //         }
            //     }
            // },
        })

        const kota = $('#kota').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: "Cari Kota...",
            language: "id",
            ajax: {
                dataType: 'json',
                url: '<?php echo base_url(); ?>master_kota/cari_kota',
                delay: 800,
                processResults: function(data, page) {
                    return {
                        results: data.map(item => {
                            return {
                                id: item.id_kota,
                                text: item.nama_kota
                            }
                        })
                    };
                },
            }
        })

        $.fn.dataTable.moment('DD-MM-YYYY');

        const tableCfg = {
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            },
            columnDefs: [{
                    searchable: false,
                    targets: [0, -1]
                },
                {
                    orderable: false,
                    targets: [-1]
                }
            ],
            stateSave: true,
            // searching: false
        }
        let mainTable = $('#main-table').DataTable(tableCfg)

        const riwayatTableCfg = {
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            }
        }
        let riwayatTable = $('#riwayat-table').DataTable(riwayatTableCfg)

        $('#cari').keypress(function(e) {
            if (e.which === 13) {
                cari()
            }
        })

        $('#btncari').click(function() {
            cari()
        })

        function cari() {
            const tglAwal = moment(rangeTgl.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhir = moment(rangeTgl.selectedDates[1]).format("YYYY-MM-DD")
            const idKota = $('#kota').val()
            const namaKota = $("#kota option:selected").text()
            const idOperator = $('#select-operator').val()
            const aktivitas = $('#aktivitas_follow_up').val()
            const cari = $('#cari').val().trim()

            const data = {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir,
                id_kota: idKota,
                nama_kota: namaKota,
                id_operator: idOperator,
                aktivitas_follow_up: aktivitas,
                cari: cari
            }

            sessionStorage.setItem('filter_cari_penawaran', JSON.stringify(data))

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>transaksi_penawaran/cari_customer_beta",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#main-table').block({
                        message: '<i class="fas fa-sync fa-spin fa-4x"></i>',
                        overlayCSS: {
                            backgroundColor: 'rgba(149, 165, 166, .5)'
                        },
                        css: {
                            padding: 0,
                            margin: 0,
                            width: '30%',
                            top: '40%',
                            left: '35%',
                            textAlign: 'center',
                            color: 'rgba(52, 152, 219, .7)',
                            border: 'none',
                            backgroundColor: 'rgba(0, 0, 0, 0)',
                            cursor: 'wait'
                        },
                    })

                    if ($.fn.DataTable.isDataTable('#main-table')) {
                        mainTable.clear().destroy()
                    }
                },
                success: function(data) {
                    if (data.length > 0) {

                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${index + 1}</td>
                                <td>`
                            if (element.countdown_konfirmasi && element.countdown_konfirmasi < 30) {
                                rows += `<span class="badge badge-info" 
                                        data-toggle="tooltip" data-placement="top" 
                                        title="Konfirmasi dalam ${element.countdown_konfirmasi} hari (${moment(element.tgl_konfirmasi_penawaran).format("DD-MM-YYYY")})">
                                        <i class="fas fa-bell"></i>
                                    </span> &nbsp;`
                            }
                            rows += `${element.nama_customer}</td>
                                <td>${element.telp_customer}</td>
                                <td>${element.alamat_customer}</td>
                                <td>${element.nama_kota}</td>
                                <td>${element.nama_propinsi}</td>
                                <td>${element.aktivitas_follow_up}</td>
                                <td style="white-space: nowrap">`
                            if (element.tgl_penawaran) {
                                rows += moment(element.tgl_penawaran).format("DD-MM-YYYY")
                            }
                            rows += `</td>
                                <td>`
                            if (element.nama_operator) {
                                rows += element.nama_operator
                            }
                            rows += `</td>
                                <td style="white-space: nowrap">`
                            if (element.tgl_beliterakhir) {
                                rows += moment(element.tgl_beliterakhir).format("DD-MM-YYYY")
                            }
                            rows += `</td>
                                <td>${element.jumlah_beli}</td>
                                <td>${element.nama_karyawan}</td>
                                <td class="text-right">
                                    <button class="btn btn-light btn-sm" 
                                        data-toggle="tooltip" data-placement="top" 
                                        title="Riwayat Pembelian"
                                        onclick='riwayat(${JSON.stringify(element.riwayat)})'>
                                        <span class="fas fa-history"></span>
                                    </button>
                                    <a class="btn btn-light btn-sm" 
                                        href="<?php echo base_url() ?>transaksi_penawaran/penawaran_tambah/${element.id_customer}" 
                                        data-toggle="tooltip" data-placement="top" 
                                        title="Input Penawaran">
                                        <span class="fas fa-phone"></span>
                                    </a>
                                </td>
                            </tr>`
                        });

                        $('#main-table tbody').html(rows)

                        $('#btnxl').attr('disabled', false)
                    } else {
                        $('#btnxl').attr('disabled', true)
                    }
                },
                complete: function() {
                    mainTable = $('#main-table').DataTable(tableCfg)
                    $('#main-table').unblock()
                }
            })
        }

        function cetak_xl() {
            const url = '<?php echo base_url() ?>transaksi_penawaran/cetak_xl/' +
                moment(rangeTgl.selectedDates[0]).format("YYYY-MM-DD") + '/' +
                moment(rangeTgl.selectedDates[1]).format("YYYY-MM-DD");
            window.location.assign(url)
        }

        $(document).ready(function() {
            if (sessionStorage.getItem('filter_cari_penawaran')) {
                const filterCari = JSON.parse(sessionStorage.getItem('filter_cari_penawaran'))

                rangeTgl.setDate([new Date(filterCari.tgl_awal), new Date(filterCari.tgl_akhir)])

                if (filterCari.id_kota) {
                    $('#kota').append(new Option(filterCari.nama_kota, filterCari.id_kota, true, true))
                        .trigger('change')
                }

                if (filterCari.id_operator) {
                    $('#select-operator').val(filterCari.id_operator)
                }

                $('#aktivitas_follow_up').val(filterCari.aktivitas_follow_up)

                $('#cari').val(filterCari.cari ?? '')
            } else {
                rangeTgl.setDate([new Date(), new Date()])
            }

            cari()
        })


        let notif = ''
        <?php if ($this->session->flashdata('notifikasi') != null) echo "notif='" . $this->session->flashdata('notifikasi') . "';" ?>

        switch (notif) {
            case 'save-ok':
                toastr.info('Data berhasil disimpan')
                break
            case 'save-err':
                toastr.error('Gagal simpan data')
                break
            case 'find-err':
                toastr.error('Tidak ditemukan customer')
                break

            default:
                break
        }

        // let id_fotos = []

        // Dropzone.autoDiscover = false
        // let img_up

        // img_up = new Dropzone("div#img-up", {
        //     url: "<?php echo base_url() ?>transaksi_penawaran/foto_simpan",
        //     addRemoveLinks: true,
        //     autoProcessQueue: false,
        //     maxFiles: 50,
        //     parallelUploads: 50,
        //     maxFilesize: 10,
        //     acceptedFiles: ".jpeg,.jpg,.png"
        // })

        // img_up.on('success', function(_, res) {
        //     if (res.status === 'save-ok') {
        //         // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-ok')

        //         id_fotos.push(res.id_foto)
        //         const id_fotos_join = id_fotos.join()

        //         $('#foto_penawaran').val(id_fotos_join)
        //     } else {
        //         // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-err')
        //         alert('Gagal')
        //     }
        // })

        // // img_up.on('successmultiple', function(_, res) {
        // // })

        // img_up.on('complete', function(_, res) {
        //     $('#form-penawaran')[0].submit()
        // })

        // $('#form-penawaran').on('submit', function(e) {
        //     e.preventDefault()
        //     if (img_up.files.length > 0) {
        //         img_up.processQueue()
        //     } else {
        //         $('#form-penawaran')[0].submit()
        //     }
        // })

        // function input(id, nama) {
        //     $('#form-penawaran')[0].reset()
        //     img_up.removeAllFiles()

        //     $('#id_customer').val(id)
        //     $('#nama_customer').val(atob(nama))

        //     $('#modal-penawaran').modal('show')
        // }

        function riwayat(listTrx) {
            riwayatTable.clear().destroy()

            if (listTrx.length > 0) {
                let rows = ''
                listTrx.forEach((element, index) => {
                    rows += `<tr>
                        <td>${index + 1}</td>
                        <td>${moment(element.tgl_riwayat_beli).format("DD-MM-YYYY")}</td>
                        <td>${element.ekspedisi}</td>
                        <td>${element.item_riwayat_beli}</td>
                        <td class="text-right">${fmtRupiah(element.grand_total, 'Rp ')}</td>
                    </tr>`
                })

                $('#riwayat-table tbody').html(rows)
            }

            riwayatTable = $('#riwayat-table').DataTable(riwayatTableCfg)

            $('#modal-riwayat').modal('show')
        }

        function hapus_data(id) {
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
                                    hapus(id);
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
    </script>


</body>

</html>