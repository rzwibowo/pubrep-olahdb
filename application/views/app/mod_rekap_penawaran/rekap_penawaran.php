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
                        <h5 class="mb-0"> Rekap Penawaran Customer</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="rentang-tanggal" class="col-sm-4 col-form-label text-right">Rentang Tgl. Penawaran</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rentang-tanggal" placeholder="Tanggal Penawaran">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="kota" class="col-sm-4 col-form-label text-right">Kota</label>
                                    <div class="col-sm-8">
                                        <select type="text" class="form-control" id="kota"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="segmentasi" class="col-sm-4 col-form-label text-right">Segmentasi</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="segmentasi" name="segmentasi">
                                            <option value="0">Semua</option>
                                            <?php
                                            foreach ($segmentasi as $rows) {
                                                echo "<option value='$rows[id_segmentasi]'>$rows[nama_segmentasi]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="kota" class="col-sm-4 col-form-label text-right">Potensi</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="kesimpulan" name="kesimpulan">
                                            <option value="0">Semua</option>
                                            <option value="potensial">Potensial</option>
                                            <option value="tidak potensial">Tidak Potensial</option>
                                            <option value="tidak diketahui">Tidak Diketahui</option>
                                            <option value="tidak respon">Tidak Direspon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="alasan" class="col-sm-4 col-form-label text-right">Alasan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="alasan" name="alasan">
                                            <option value="0">Semua</option>
                                            <?php
                                            foreach ($alasan as $rows) {
                                                echo "<option value='$rows[id_alasan]'>$rows[nama_alasan]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="cari" class="col-sm-4 col-form-label text-right">Customer</label>
                                    <div class="col-sm-8">
                                        <input type="search" class="form-control" id="cari" placeholder="Cari Nama/No. Telp Customer...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
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

                        <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table class="table table-striped table-hover table-sm border-bottom" id="main-table" style="font-size: 12px; font-weight:bold">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                        <th class="sort pr-1 align-middle" style="width: 120px;">Nama</th>
                                        <th class="sort pr-1 align-middle" style="width: 140px;">Telp</th>
                                        <th class="sort pr-1 align-middle">Kota</th>
                                        <th class="sort pr-1 align-middle">Prospek Penawaran</th>
                                        <th class="sort pr-1 align-middle">Aktivitas Follow Up</th>
                                        <th class="sort pr-1 align-middle">Media</th>
                                        <th class="sort pr-1 align-middle">Alasan</th>
                                        <th class="sort pr-1 align-middle">Kesimpulan</th>
                                        <th class="sort pr-1 align-middle">Segmentasi</th>
                                        <th class="sort pr-1 align-middle">Tanggal Penawaran</th>
                                        <th class="sort pr-1 align-middle">Nama Operator</th>
                                        <th class="sort pr-1 align-middle">Gol</th>
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

    <div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Penawaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                        <table class="table table-striped table-hover table-sm border-bottom" id="riwayat-table" style="font-size: 12px; font-weight:bold">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                    <th class="sort pr-1 align-middle">Kode Penawaran</th>
                                    <th class="sort pr-1 align-middle">Prospek Penawaran</th>
                                    <th class="sort pr-1 align-middle">Aktivitas Follow Up</th>
                                    <th class="sort pr-1 align-middle">Media</th>
                                    <th class="sort pr-1 align-middle">Alasan</th>
                                    <th class="sort pr-1 align-middle">Kesimpulan</th>
                                    <th class="sort pr-1 align-middle">Segmentasi</th>
                                    <th class="sort pr-1 align-middle">Tanggal Penawaran</th>
                                    <th class="sort pr-1 align-middle">Nama Operator</th>
                                    <th class="sort pr-1 align-middle text-left" style="width: 80px;"></th>
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

    <div class="modal fade" id="modal-penawaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="z-index: 1055;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Penawaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4>Penawaran</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Kode Penawaran</label>
                                <p class="data-dtl" id="dtl-kode"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Tanggal Penawaran</label>
                                <p class="data-dtl" id="dtl-tgl"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Media Penawaran</label>
                                <p class="data-dtl" id="dtl-media"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Prospek Penawaran</label>
                                <p class="data-dtl" id="dtl-prospek"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Alasan</label>
                                <p class="data-dtl" id="dtl-alasan"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Kesimpulan</label>
                                <p class="data-dtl" id="dtl-kesimpulan"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" style="margin-bottom:0">Keterangan</label>
                                <p class="data-dtl" id="dtl-keterangan"></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Bukti Penawaran</h4>
                    <div id="galeri-kosong" class="row">
                        <div class="col-md-12 text-center text-black-50">
                            <div class="my-3">
                                <i class="fas fa-ghost fa-5x"></i>
                            </div>
                            <h6>Tidak ada gambar</h6>
                        </div>
                    </div>
                    <div id="galeri" class="row">
                        <div class="col-sm-4 col-lg-3 mb-4">
                            <a class="item" href="<?php echo base_url(); ?>assets/img/illustrations/golden.png">
                                <img class="rounded img-fluid" src="<?php echo base_url(); ?>assets/img/illustrations/golden.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button> -->
                </div>
            </div>
            </form>
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
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 1) {
                    var range = instance.formatDate(selectedDates[1], 'U') - instance.formatDate(selectedDates[0], 'U');
                    range = range / 86400;

                    if (range > 30) {
                        alert("Maksimal rentang tanggal adalah 31 hari");
                        instance.clear()
                    }
                }
            },
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

        $('#galeri').lightGallery({
            selector: '.item'
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
            const segmentasi = $('#segmentasi').val()
            const alasan = $('#alasan').val()
            const kesimpulan = $('#kesimpulan').val()
            const cari = $('#cari').val().trim()

            const data = {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir,
                id_kota: idKota,
                nama_kota: namaKota,
                id_alasan: alasan,
                id_segmentasi: segmentasi,
                kesimpulan: kesimpulan,
                cari: cari
            }

            sessionStorage.setItem('filter_cari_penawaran_rekap', JSON.stringify(data))

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>rekap_penawaran/cari_customer_beta",
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
                            rows += `<tr`
                            if (element.status_follow_up === 'Y') {
                                rows += ` class="table-success"`
                            }
                            rows += `>
                                <td>${index + 1}</td>
                                <td>
                                    <a href="javascript:void(0)" 
                                        onclick='riwayat(${JSON.stringify(element.rekap)})'>
                                        ${element.nama_customer}
                                    </a>
                                </td>
                                <td>${element.telp_customer}</td>
                                <td>${element.nama_kota}</td>
                                <td>${element.prospek_penawaran}</td>
                                <td>${element.aktivitas_follow_up}</td>
                                <td>${element.media_penawaran}</td>
                                <td>${element.nama_alasan}</td>
                                <td>${element.kesimpulan_penawaran}</td>
                                <td>${element.nama_segmentasi}</td>
                                <td>${moment(element.tgl_penawaran).format("DD-MM-YYYY")}</td>
                                <td>${element.nama_operator}</td>
                                <td>${element.status_follow_up === 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'}</td>
                                <td class="text-right">
                                    <button class="btn btn-light btn-sm" 
                                        data-toggle="tooltip" data-placement="top" 
                                        title="Riwayat Penawaran"
                                        onclick='riwayat(${JSON.stringify(element.rekap)})'>
                                        <span class="fas fa-history"></span>
                                    </button>
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
            const url = '<?php echo base_url() ?>rekap_penawaran/cetak_xl/' +
                moment(rangeTgl.selectedDates[0]).format("YYYY-MM-DD") + '/' +
                moment(rangeTgl.selectedDates[1]).format("YYYY-MM-DD");
            window.location.assign(url)
        }

        $(document).ready(function() {
            if (sessionStorage.getItem('filter_cari_penawaran_rekap')) {
                const filterCari = JSON.parse(sessionStorage.getItem('filter_cari_penawaran_rekap'))

                rangeTgl.setDate([new Date(filterCari.tgl_awal), new Date(filterCari.tgl_akhir)])

                if (filterCari.id_kota) {
                    $('#kota').append(new Option(filterCari.nama_kota, filterCari.id_kota, true, true))
                        .trigger('change')
                }

                $('#segmentasi').val(filterCari.id_segmentasi)
                $('#kesimpulan').val(filterCari.kesimpulan)
                $('#cari').val(filterCari.cari ?? '')
            } else {
                rangeTgl.setDate([new Date(), new Date()])
            }

            cari()

            $('#modal-riwayat').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });
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

            default:
                break
        }

        function showDetail(detail) {
            $('.data-dtl').text('-')
            $('#galeri').html('')
            $('#galeri').hide()
            $('#galeri-kosong').show()

            $('#dtl-tgl').text(moment(detail.tgl_penawaran).format('DD-MM-YYYY'))
            $('#dtl-prospek').text(detail.prospek_penawaran)
            $('#dtl-media').text(detail.media_penawaran)
            $('#dtl-alasan').text(detail.nama_alasan)
            $('#dtl-keterangan').text(detail.keterangan_penawaran)
            $('#dtl-kesimpulan').text(detail.kesimpulan_penawaran)
            if (detail.gambar.length > 0) {
                $('#galeri').data('lightGallery').destroy(true)

                let galeries = ''
                detail.gambar.forEach(element => {
                    galeries += `
                    <div class="col-sm-4 col-lg-3 mb-4">
                        <a class="item" href="<?php echo base_url(); ?>assets/gambar/penawaran/${element.filename_penawaran_gambar}">
                            <img class="rounded img-fluid" src="<?php echo base_url(); ?>assets/gambar/penawaran/${element.filename_penawaran_gambar}" alt="">
                        </a>
                    </div>
                    `
                });

                $('#galeri-kosong').hide()
                $('#galeri').html(galeries)
                $('#galeri').show()

                $('#galeri').lightGallery({
                    selector: '.item'
                })
            }

            $('#modal-penawaran').modal('show')

        }

        function riwayat(listTrx) {
            riwayatTable.clear().destroy()

            if (listTrx.length > 0) {
                let rows = ''
                listTrx.forEach((element, index) => {
                    rows += `<tr>
                        <td>${index + 1}</td>
                        <td>
                            <a href="javascript:void(0)" onclick='showDetail(${JSON.stringify(element)})'>
                                ${element.kode_penawaran}
                            </a>
                        </td>
                        <td>${element.prospek_penawaran}</td>
                        <td>${element.aktivitas_follow_up}</td>
                        <td>${element.media_penawaran}</td>
                        <td>${element.nama_alasan}</td>
                        <td>${element.kesimpulan_penawaran}</td>
                        <td>${element.nama_segmentasi}</td>
                        <td>${moment(element.tgl_penawaran).format("DD-MM-YYYY")}</td>
                        <td>${element.nama_operator}</td>
                        <td>
                            <button class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Penawaran" onclick='showDetail(${JSON.stringify(element)})'>
                                <span class="fas fa-info"></span>
                            </button>`

                    if (element.id_operator === '<?php echo $this->session->id_operator ?>' ||
                        <?php echo $this->session->id_level ?> === 1) {
                        rows += `<a class='btn btn-light btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data' onclick='hapus_data(${element.id_penawaran})'>
                                    <span class='fas fa-trash-alt'></span>
                                </a>`
                    }

                    rows += `</td>
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
            var datahapus = "id_penawaran=" + id;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>rekap_penawaran/penawaran_hapus",
                data: datahapus,
                cache: false,
                success: function(data) {
                    var urltarget = "<?php echo base_url(); ?>rekap_penawaran/penawaran_rekap";
                    $(location).attr('href', urltarget);
                }
            });
        }
    </script>


</body>

</html>