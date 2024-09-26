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
                                <h5 class="mb-2 mb-md-0">Input Transaksi Penawaran</h5>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="Riwayat Pembelian" onclick="riwayat()">
                                    <span class="fas fa-history"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $attributes = array('id' => 'form-penawaran');
                echo form_open("transaksi_penawaran/penawaran_tambah_proses", $attributes);
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_customer">Nama</label>
                                                    <input class="form-control" id="nama_customer" name="nama_customer" type="text" value="<?php echo $customer->nama_customer ?>" placeholder="Username" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="telp_customer">Prospek</label>
                                                <select class="form-control" id="prospek_penawaran" name="prospek_penawaran" required>
                                                    <option value="follow up">Follow Up</option>
                                                    <option value="maintenance">Maintenance</option>
                                                    <option value="scale up">Scale Up</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telp_customer">Aktivitas Follow Up</label>
                                                <select class="form-control" id="aktivitas_follow_up" name="aktivitas_follow_up">
                                                    <option value="prospek">Prospek</option>
                                                    <option value="negosiasi">Negosiasi</option>
                                                    <option value="closing">Closing</option>
                                                    <option value="dihentikan">Dihentikan</option>
                                                    <option value="terbuka" selected>Terbuka</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="telp_customer">Cara Penawaran</label>
                                                <select class="form-control" id="media_penawaran" name="media_penawaran" required>
                                                    <option value="wa">WhatsApp</option>
                                                    <option value="telp">Telepon</option>
                                                    <option value="door">Door to Door</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_level">Segmentasi</label>
                                                    <select class="form-control" id="id_segmentasi" name="id_segmentasi" required>
                                                        <?php
                                                        foreach ($segmentasi as $rows) {
                                                            echo "<option value='$rows[id_segmentasi]'>$rows[nama_segmentasi]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nama_level">Alasan</label>
                                                <select class="form-control" id="id_alasan" name="id_alasan" required>
                                                    <?php
                                                    foreach ($alasan as $rows) {
                                                        echo "<option value='$rows[id_alasan]'>$rows[nama_alasan]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_level">Keterangan</label>
                                                    <textarea name="keterangan_penawaran" id="keterangan_penawaran" cols="30" rows="3" class="form-control" placeholder="Keterangan" maxlength="500"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telp_customer">Kesimpulan</label>
                                                    <select class="form-control" id="kesimpulan_penawaran" name="kesimpulan_penawaran" required>
                                                        <option value="potensial">Potensial</option>
                                                        <option value="tidak potensial">Tidak Potensial</option>
                                                        <option value="tidak diketahui">Tidak Diketahui</option>
                                                        <option value="tidak respon">Tidak Direspon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Konfirmasi</label>
                                                    <input type="text" class="form-control" id="tgl_konfirmasi_penawaran" name="tgl_konfirmasi_penawaran" placeholder="Tanggal Konfirmasi Penawaran">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="id_customer" name="id_customer" value="<?php echo $this->uri->segment(3) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 pr-lg-2">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Bukti Penawaran</h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="form-row">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <div class="dropzone no-margin" id="img-up">
                                                <div class="fallback">
                                                    <input name="gambar" type="file" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <input type="hidden" id="foto_penawaran" name="foto_penawaran">
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
                                <a href="<?php echo base_url() . "transaksi_penawaran/penawaran"; ?>" class="btn btn-falcon-primary btn-sm">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>


                </form>

                <?php include(APPPATH . 'views/app/main-footer.php'); ?>
            </div>
        </div>
    </main>

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
                                <?php
                                $i = 0;
                                foreach ($riwayat as $r) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($r->tgl_riwayat_beli)) ?></td>
                                        <td><?php echo $r->ekspedisi ?></td>
                                        <td><?php echo $r->item_riwayat_beli ?></td>
                                        <td class="text-right">Rp <?php echo number_format($r->grand_total, 0, ',', '.') ?></td>
                                    </tr>
                                <?php } ?>
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
    <script>
        const tglKonfirm = $('#tgl_konfirmasi_penawaran').flatpickr({
            minDate: 'today',
            dateFormat: 'd/m/Y',
            locale: 'id'
        })

        $.fn.dataTable.moment('DD-MM-YYYY');

        const riwayatTableCfg = {
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            }
        }
        let riwayatTable = $('#riwayat-table').DataTable(riwayatTableCfg)

        let id_fotos = []
        let success = false

        Dropzone.autoDiscover = false
        let img_up

        img_up = new Dropzone("div#img-up", {
            url: "<?php echo base_url() ?>transaksi_penawaran/foto_simpan",
            addRemoveLinks: true,
            dictRemoveFile: '<i class="fas fa-times"></i>',
            autoProcessQueue: false,
            maxFiles: 50,
            parallelUploads: 50,
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png"
        })

        img_up.on('success', function(_, res) {
            if (res.status === 'save-ok') {
                // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-ok')

                id_fotos.push(res.id_foto)
                const id_fotos_join = id_fotos.join()

                success = true
                $('#foto_penawaran').val(id_fotos_join)
            } else {
                // location.replace('<?php echo base_url() ?>galeri/konten?notifikasi=save-err')
                success = false
                alert('Gagal. Cek format gambar, pastikan bukan didownload dari Whatsapp Web.')
            }
        })

        // img_up.on('successmultiple', function(_, res) {
        // })

        img_up.on('complete', function(_, res) {
            if (success) {
                $('#form-penawaran')[0].submit()
            }
        })

        $('#form-penawaran').on('submit', function(e) {
            e.preventDefault()
            if (img_up.files.length > 0) {
                img_up.processQueue()
            } else {
                $('#form-penawaran')[0].submit()
            }
        })

        function riwayat() {
            $('#modal-riwayat').modal('show')
        }

        function cekProspek() {
            if ($('#prospek_penawaran').val() !== 'follow up') {
                $('#aktivitas_follow_up').val('terbuka')
                $('#aktivitas_follow_up').attr('disabled', true)
            } else {
                $('#aktivitas_follow_up').attr('disabled', false)
            }
        }
        cekProspek()
        $('#prospek_penawaran').change(function() {
            cekProspek()
        })
    </script>
</body>

</html>