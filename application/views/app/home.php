<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include 'main-head.php'; ?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">

            <?php include 'main-menu.php'; ?>

            <div class="content">
                <?php include 'main-navbar.php'; ?>

                <div class="card mb-3">
                    <div class="card-body rounded-soft bg-gradient">
                        <div class="row text-white align-items-center no-gutters">
                            <div class="col">
                                <h4 class="text-white mb-0">Pembelian dalam 12 Bulan Terakhir</h4>
                                <!-- <p class="fs--1 font-weight-semi-bold">Kemarin <span class="opacity-50">Rp 1.556.000.000</span>
                                </p> -->
                            </div>
                            <div class="col d-none d-sm-block">
                                <div class="form-group row pr-3">
                                    <label for="customer" class="col-sm-3 col-form-label text-right">Customer</label>
                                    <div class="col-sm-6">
                                        <select type="text" class="form-control" id="customer"></select>
                                    </div>
                                    <button class="col-sm-3 btn btn-light" onclick="getData()">Tampilkan</button>
                                </div>
                                <!-- <select class="custom-select custom-select-sm mb-3" id="dashboard-chart-select">
                                    <option value="all">All Payments</option>
                                    <option value="successful" selected="selected">Successful Payments</option>
                                    <option value="failed">Failed Payments</option>
                                </select> -->
                            </div>
                        </div>
                        <canvas class="max-w-100 rounded" id="chart-line-customer" width="1618" height="375" aria-label="Line chart" role="img"></canvas>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body p-3">
                        <h5 class="mb-3">Filter Customer</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-tgl-beli" type="checkbox">
                                    <label class="custom-control-label" for="chk-tgl-beli">Tgl. Beli</label>
                                </div>
                                <input class="form-control" type="text" id="rentang-tgl-beli">
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-tgl-penawaran" type="checkbox" checked>
                                    <label class="custom-control-label" for="chk-tgl-penawaran">Tgl. Penawaran</label>
                                </div>
                                <input class="form-control" type="text" id="rentang-tgl-penawaran">
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-kota" type="checkbox">
                                    <label class="custom-control-label" for="chk-kota">Kota</label>
                                </div>
                                <select type="text" class="form-control" id="kota"></select>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-propinsi" type="checkbox">
                                    <label class="custom-control-label" for="chk-propinsi">Propinsi</label>
                                </div>
                                <select type="text" class="form-control" id="propinsi"></select>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <label>Customer</label>
                                <input type="text" class="form-control" placeholder="Cari nama atau no. telepon customer..." id="cari">
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary mr-1 mb-1" type="button" id="btncari" name="btncari" onclick="cari()">Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="dashboard-data-table">
                            <table class="table table-sm table-dashboard fs--1 border-bottom" id="dasbor-table">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th class="sort pr-1 align-middle">Nama Customer</th>
                                        <th class="sort pr-1 align-middle">No. HP</th>
                                        <th class="sort pr-1 align-middle">Kota</th>
                                        <th class="sort pr-1 align-middle">Propinsi</th>
                                        <th class="sort pr-1 align-middle"><abbr title="Tanggal Beli Terakhir">Tgl. Beli</abbr></th>
                                        <th class="sort pr-1 align-middle">Jumlah Beli</th>
                                        <th class="sort pr-1 align-middle"><abbr title="Tanggal Penawaran Terakhir">Tgl. Penawaran</abbr></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body p-3">
                        <h5 class="mb-3">Filter Kota/Propinsi</h5>
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label>Tgl. Beli</label>
                                <input class="form-control" type="text" id="rentang-tgl-beli-kotaprop">
                            </div>
                            
                            <div class="col-md-6 offset-md-3 text-right">
                                <button class="btn btn-primary mr-1 mb-1" type="button" name="btncari" onclick="cariKotaProp()">Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="dashboard-data-table">
                                    <table class="table table-sm table-dashboard fs--1 border-bottom" id="dasbor-table-kota">
                                        <thead class="bg-200 text-900">
                                            <tr>
                                                <th class="sort pr-1 align-middle">Kota</th>
                                                <th class="sort pr-1 align-middle">Nama Customer</th>
                                                <th class="sort pr-1 align-middle">Jumlah Beli</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="dashboard-data-table">
                                    <table class="table table-sm table-dashboard fs--1 border-bottom" id="dasbor-table-propinsi">
                                        <thead class="bg-200 text-900">
                                            <tr>
                                                <th class="sort pr-1 align-middle">Propinsi</th>
                                                <th class="sort pr-1 align-middle">Nama Customer</th>
                                                <th class="sort pr-1 align-middle">Jumlah Beli</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card bg-light mb-3">
                    <div class="card-body p-3">
                        <h5 class="mb-3">Filter Produk 10 Terbanyak</h5>
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label>Tgl. Beli</label>
                                <input class="form-control" type="text" id="rentang-tgl-beli-produk">
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-kota-produk" type="checkbox">
                                    <label class="custom-control-label" for="chk-kota-produk">Kota</label>
                                </div>
                                <select type="text" class="form-control" id="kota-produk"></select>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="chk-propinsi-produk" type="checkbox">
                                    <label class="custom-control-label" for="chk-propinsi-produk">Propinsi</label>
                                </div>
                                <select type="text" class="form-control" id="propinsi-produk"></select>
                            </div>
                            <div class="col-md-3 text-right">
                                <button class="btn btn-primary mr-1 mb-1" type="button" name="btncari" onclick="cariProduk()">Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="dashboard-data-table">
                                    <table class="table table-sm table-dashboard fs--1 border-bottom" id="dasbor-table-produk">
                                        <thead class="bg-200 text-900">
                                            <tr>
                                                <th class="sort pr-1 align-middle">Nama Produk</th>
                                                <th class="sort pr-1 align-middle">Jumlah Beli</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="mb-3">Grafik Produk</h5>
                                <canvas class="max-w-100 rounded" id="chart-produk" width="809" height="375" aria-label="Bar chart" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card bg-light mb-3">
                    <div class="card-body p-3">
                        <h5 class="mb-3">Filter Operator</h5>
                        <div class="row mb-3 align-items-end">
                            <div class="col-md-3">
                                <label>Tgl. Penawaran</label>
                                <input class="form-control" type="text" id="rentang-tgl-penawaran-op">
                            </div>
                            <div class="col-md-3">
                                <label>Operator</label>
                                <input type="text" class="form-control" placeholder="Cari nama operator..." id="cari-op">
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary mr-1 mb-1" type="button" name="btncari" onclick="cariOp()">Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="dashboard-data-table">
                            <table class="table table-sm table-dashboard fs--1 border-bottom" id="dasbor-table-op">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th rowspan="2">Nama Operator</th>
                                        <th colspan="3">Prospek Penawaran</th>
                                        <th colspan="4">Kesimpulan Penawaran</th>
                                        <th rowspan="2">Total Penawaran</th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="sort pr-1 align-middle">Follow Up</th>
                                        <th class="sort pr-1 align-middle">Maintenance</th>
                                        <th class="sort pr-1 align-middle">Scale Up</th>
                                        <th class="sort pr-1 align-middle">Potensial</th>
                                        <th class="sort pr-1 align-middle">Tidak Potensial</th>
                                        <th class="sort pr-1 align-middle">Tidak Diketahui</th>
                                        <th class="sort pr-1 align-middle">Tidak Respon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="mb-3">Persentase Prospek</h5>
                                <canvas class="max-w-100 rounded" id="chart-prospek-op" width="809" height="375" aria-label="Pie chart" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="mb-3">Persentase Kesimpulan</h5>
                                <canvas class="max-w-100 rounded" id="chart-kesimpulan-op" width="809" height="375" aria-label="Pie chart" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Riwayat Pembelian</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table table-striped table-hover table-sm border-bottom" id="riwayat-table" style="font-size: 12px; font-weight:bold">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th class="sort pr-1 align-middle" style="width: 30px;">No</th>
                                                <th class="sort pr-1 align-middle">Nama Customer</th>
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

                <?php include 'main-footer.php'; ?>
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
    <script>
        $(document).ready(function() {
            getData()

            rangeTglBeli.setDate([new Date(), new Date()])
            rangeTglBeliKotaProp.setDate([new Date(), new Date()])
            rangeTglBeliProduk.setDate([new Date(), new Date()])
            rangeTglPenawaran.setDate([new Date(), new Date()])
            rangeTglPenawaranOp.setDate([new Date(), new Date()])
        })

        let id_customer = '';

        const blockUICfg = {
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
        }

        $.fn.dataTable.moment('DD-MM-YYYY');

        const riwayatTableCfg = {
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            }
        }
        let riwayatTable = $('#riwayat-table').DataTable(riwayatTableCfg)

        function riwayat(id_customer, bulan_tahun) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/riwayat_beli",
                data: {
                    id_customer: id_customer,
                    bulan_tahun: bulan_tahun
                },
                beforeSend: function() {
                    riwayatTable.clear().destroy()
                },
                success: function(data) {
                    if (data.length > 0) {
                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${index + 1}</td>
                                <td>${element.nama_customer}</td>
                                <td>${moment(element.tgl_riwayat_beli).format("DD-MM-YYYY")}</td>
                                <td>${element.ekspedisi}</td>
                                <td>${element.item_riwayat_beli}</td>
                                <td class="text-right">${fmtRupiah(element.grand_total, 'Rp ')}</td>
                            </tr>`
                        })

                        $('#riwayat-table tbody').html(rows)
                    }
                },
                complete: function() {
                    riwayatTable = $('#riwayat-table').DataTable(riwayatTableCfg)
                    $('#modal-riwayat').modal('show')
                }
            });
        }

        const flatPickrCfg = {
            mode: 'range',
            dateFormat: 'd/m/Y',
            locale: 'id'
        }

        const rangeTglBeli = $('#rentang-tgl-beli').flatpickr(flatPickrCfg)
        const rangeTglPenawaran = $('#rentang-tgl-penawaran').flatpickr(flatPickrCfg)

        const rangeTglPenawaranOp = $('#rentang-tgl-penawaran-op').flatpickr(flatPickrCfg)

        const rangeTglBeliKotaProp = $('#rentang-tgl-beli-kotaprop').flatpickr(flatPickrCfg)
        const rangeTglBeliProduk = $('#rentang-tgl-beli-produk').flatpickr(flatPickrCfg)

        var ctxCustomer = document.getElementById('chart-line-customer').getContext('2d');

        var getChartBackground = function getChartBackground() {
            var ctx_ = ctxCustomer;

            // if (storage.isDark) {
            //     var _gradientFill = ctx_.createLinearGradient(0, 0, 0, ctx.canvas.height);

            //     _gradientFill.addColorStop(0, utils.rgbaColor(utils.colors.primary, 0.5));

            //     _gradientFill.addColorStop(1, 'transparent');

            //     return _gradientFill;
            // }

            var gradientFill = ctx_.createLinearGradient(0, 0, 0, 250);
            gradientFill.addColorStop(0, 'rgba(255, 255, 255, 0.3)');
            gradientFill.addColorStop(1, 'rgba(255, 255, 255, 0)');
            // gradientFill.addColorStop(0, 'rgba(191, 144, 86, .3)');
            // gradientFill.addColorStop(1, 'rgba(217, 171, 115, 0)');
            return gradientFill;
        };

        var myChart = new Chart(ctxCustomer, {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'x-axis',
                    xPadding: 20,
                    yPadding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function label(tooltipItem) {
                            return myChart.data.labels[tooltipItem.index] + " - " + tooltipItem.yLabel + "x";
                        },
                        title: function title() {
                            return null;
                        }
                    }
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            show: true,
                            labelString: 'Bulan'
                        },
                        ticks: {
                            fontColor: 'rgba(255,255,255,0.7)',
                            fontStyle: 600
                        },
                        gridLines: {
                            color: 'rgba(255,255,255,0.1)',
                            zeroLineColor: 'rgba(255,255,255,0.1)',
                            lineWidth: 1
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            show: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            fontColor: 'rgba(255,255,255,0.7)',
                            fontStyle: 600,
                            beginAtZero: true
                        },
                        gridLines: {
                            color: 'rgba(255,255,255,0.1)',
                            zeroLineColor: 'rgba(255,255,255,0.1)',
                            lineWidth: 1
                        }
                    }]
                },
                onClick: function(evt, _element) {
                    const activePoint = myChart.getElementAtEvent(evt);
                    const datasetIndex = activePoint[0]._datasetIndex;
                    const itemIndex = activePoint[0]._index;

                    const bulanTahun = myChart.data.labels[itemIndex]
                    riwayat(id_customer, bulanTahun)
                },
                plugins: {
                    datalabels: {
                        display: false,
                    },
                }
            },
        });

        function updateChart(label, data) {
            const label_ = label
            const dataset_ = [{
                borderWidth: 2,
                data: data,
                borderColor: 'rgba(255, 255, 255, 0.8)',
                backgroundColor: getChartBackground(myChart)
            }];

            myChart.data.labels = label_
            myChart.data.datasets = dataset_

            myChart.update()
        }

        function getData() {
            const id_customer_ = $('#customer').val()
            id_customer = id_customer_

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/stat_beli",
                data: {
                    id_customer: id_customer
                },
                success: function(data) {
                    const bulan = data.map(item => {
                        return `${item.bulan}/${item.tahun}`
                    })
                    const dataBeli = data.map(item => {
                        return item.jumlah
                    })

                    updateChart(bulan, dataBeli)
                }
            });
        }

        const customer = $('#customer').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: "Cari Nama/Telp Customer...",
            language: "id",
            ajax: {
                dataType: 'json',
                url: '<?php echo base_url(); ?>dashboard/cari_customer',
                delay: 800,
                processResults: function(data, page) {
                    return {
                        results: data
                            .map(item => {
                                return {
                                    id: item.id_customer,
                                    text: `${item.nama_customer} (${item.telp_customer})`
                                }
                            })
                    };
                },
                // templateResult: fmtOption,
                // templateSelection: fmtSelect
            }
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
                        results: data
                            .map(item => {
                                return {
                                    id: item.id_kota,
                                    text: item.nama_kota
                                }
                            })
                    };
                },
            }
        })

        const propinsi = $('#propinsi').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: "Cari Propinsi...",
            language: "id",
            ajax: {
                dataType: 'json',
                url: '<?php echo base_url(); ?>master_propinsi/cari_propinsi',
                delay: 800,
                processResults: function(data, page) {
                    return {
                        results: data
                            .map(item => {
                                return {
                                    id: item.id_propinsi,
                                    text: item.nama_propinsi
                                }
                            })
                    };
                },
            }
        })

        const kotaProduk = $('#kota-produk').select2({
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
                        results: data
                            .map(item => {
                                return {
                                    id: item.id_kota,
                                    text: item.nama_kota
                                }
                            })
                    };
                },
            }
        })

        const propinsiProduk = $('#propinsi-produk').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: "Cari Propinsi...",
            language: "id",
            ajax: {
                dataType: 'json',
                url: '<?php echo base_url(); ?>master_propinsi/cari_propinsi',
                delay: 800,
                processResults: function(data, page) {
                    return {
                        results: data
                            .map(item => {
                                return {
                                    id: item.id_propinsi,
                                    text: item.nama_propinsi
                                }
                            })
                    };
                },
            }
        })

        const tableCfg = {
            language: {
                url: '<?php echo base_url(); ?>assets/lib/datatables/id.json'
            },
            // columnDefs: [
            //     {
            //         searchable: false,
            //         targets: [0, -1]
            //     },
            //     {
            //         orderable: false,
            //         targets: [-1]
            //     }
            // ],
            // stateSave: true,
            searching: false,
            lengthChange: false
        }
        let dasborTable = $('#dasbor-table').DataTable(tableCfg)
        let dasborTableOp = $('#dasbor-table-op').DataTable(tableCfg)
        let dasborTableKota = $('#dasbor-table-kota').DataTable(tableCfg)
        let dasborTablePropinsi = $('#dasbor-table-propinsi').DataTable(tableCfg)
        let dasborTableProduk = $('#dasbor-table-produk').DataTable(tableCfg)

        function cari() {
            const tglAwalBeli = moment(rangeTglBeli.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhirBeli = moment(rangeTglBeli.selectedDates[1]).format("YYYY-MM-DD")
            const tglAwalPenawaran = moment(rangeTglPenawaran.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhirPenawaran = moment(rangeTglPenawaran.selectedDates[1]).format("YYYY-MM-DD")
            const idKota = $('#kota').val()
            const idPropinsi = $('#propinsi').val()
            const cari = $('#cari').val().trim()

            const data = {
                cari: cari
            }

            if ($('#chk-tgl-beli').is(':checked')) {
                data.tgl_awal_beli = tglAwalBeli
                data.tgl_akhir_beli = tglAkhirBeli
            }

            if ($('#chk-tgl-penawaran').is(':checked')) {
                data.tgl_awal_penawaran = tglAwalPenawaran
                data.tgl_akhir_penawaran = tglAkhirPenawaran
            }

            if ($('#chk-kota').is(':checked')) {
                data.id_kota = idKota
            }

            if ($('#chk-propinsi').is(':checked')) {
                data.id_propinsi = idPropinsi
            }

            // sessionStorage.setItem('filter_cari_penawaran', JSON.stringify(data))

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/stat_customer",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#dasbor-table').block(blockUICfg)

                    if ($.fn.DataTable.isDataTable('#dasbor-table')) {
                        dasborTable.clear().destroy()
                    }
                },
                success: function(data) {
                    if (data.length > 0) {

                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${element.nama_customer}</td>
                                <td>${element.telp_customer}</td>
                                <td>${element.nama_kota}</td>
                                <td>${element.nama_propinsi}</td>
                                <td>`
                            if (element.tgl_beliterakhir) {
                                rows += moment(element.tgl_beliterakhir).format("DD-MM-YYYY")
                            }
                            rows += `</td>
                                <td>${element.jumlah_beli}</td>
                                <td>`
                            if (element.tgl_penawaran) {
                                rows += moment(element.tgl_penawaran).format("DD-MM-YYYY")
                            }
                            rows += `</td>
                            </tr>`
                        });

                        $('#dasbor-table tbody').html(rows)
                    }
                },
                complete: function() {
                    dasborTable = $('#dasbor-table').DataTable(tableCfg)
                    $('#dasbor-table').unblock()
                }
            })
        }

        function cariOp() {
            const tglAwalPenawaran = moment(rangeTglPenawaranOp.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhirPenawaran = moment(rangeTglPenawaranOp.selectedDates[1]).format("YYYY-MM-DD")
            const cari = $('#cari-op').val().trim()

            const data = {
                cari: cari,
                tgl_awal_penawaran: tglAwalPenawaran,
                tgl_akhir_penawaran: tglAkhirPenawaran
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/stat_operator",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#dasbor-table-op').block(blockUICfg)

                    if ($.fn.DataTable.isDataTable('#dasbor-table-op')) {
                        dasborTableOp.clear().destroy()
                    }
                },
                success: function(data) {
                    if (data.length > 0) {

                        let rows = ''
                        let prospek = [0, 0, 0]
                        let kesimpulan = [0, 0, 0, 0]
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${element.nama_operator}</td>
                                <td>${element.follow_up}</td>
                                <td>${element.maintenance}</td>
                                <td>${element.scale_up}</td>
                                <td>${element.potensial}</td>
                                <td>${element.tidak_potensial}</td>
                                <td>${element.tidak_diketahui}</td>
                                <td>${element.tidak_respon}</td>
                                <td>${element.total_penawaran}</td>
                                <td>
                                    <button type="button" class="btn btn-light btn-sm"
                                        onclick='chartOpIndividu(${JSON.stringify(element)}, ${index})'>
                                        <i class="fas fa-chart-pie"></i>
                                    </button>
                                </td>
                            </tr>`

                            prospek[0] += parseInt(element.follow_up)
                            prospek[1] += parseInt(element.maintenance)
                            prospek[2] += parseInt(element.scale_up)

                            kesimpulan[0] += parseInt(element.potensial)
                            kesimpulan[1] += parseInt(element.tidak_potensial)
                            kesimpulan[2] += parseInt(element.tidak_diketahui)
                            kesimpulan[3] += parseInt(element.tidak_respon)
                        });

                        $('#dasbor-table-op tbody').html(rows)
                        updateChartOp(opProspekChart, prospek, colorProspekCfg)
                        updateChartOp(opKesimpulanChart, kesimpulan, colorKesimpulanCfg)
                    }
                },
                complete: function() {
                    dasborTableOp = $('#dasbor-table-op').DataTable(tableCfg)
                    $('#dasbor-table-op').unblock()
                }
            })
        }

        function cariKotaProp() {
            const tglAwal = moment(rangeTglBeliKotaProp.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhir = moment(rangeTglBeliKotaProp.selectedDates[1]).format("YYYY-MM-DD")

            const data = {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/pembelian_per_kota_beta2",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#dasbor-table-kota').block(blockUICfg)

                    if ($.fn.DataTable.isDataTable('#dasbor-table-kota')) {
                        dasborTableKota.clear().destroy()
                    }
                },
                success: function(data) {
                    if (data.length > 0) {

                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${element.nama_kota}</td>
                                <td>${element.nama_customer}</td>
                                <td>${element.jml_beli}</td>
                            </tr>`
                        });

                        $('#dasbor-table-kota tbody').html(rows)
                    }
                },
                complete: function() {
                    dasborTableKota = $('#dasbor-table-kota').DataTable(tableCfg)
                    $('#dasbor-table-kota').unblock()
                }
            })

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/pembelian_per_propinsi_beta2",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#dasbor-table-propinsi').block(blockUICfg)

                    if ($.fn.DataTable.isDataTable('#dasbor-table-propinsi')) {
                        dasborTablePropinsi.clear().destroy()
                    }
                },
                success: function(data) {
                    if (data.length > 0) {

                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${element.nama_propinsi}</td>
                                <td>${element.nama_customer}</td>
                                <td>${element.jml_beli}</td>
                            </tr>`
                        });

                        $('#dasbor-table-propinsi tbody').html(rows)
                    }
                },
                complete: function() {
                    dasborTablePropinsi = $('#dasbor-table-propinsi').DataTable(tableCfg)
                    $('#dasbor-table-propinsi').unblock()
                }
            })
        }

        function cariProduk() {
            const tglAwal = moment(rangeTglBeliProduk.selectedDates[0]).format("YYYY-MM-DD")
            const tglAkhir = moment(rangeTglBeliProduk.selectedDates[1]).format("YYYY-MM-DD")
            const idKota = $('#kota-produk').val()
            const idPropinsi = $('#propinsi-produk').val()

            const data = {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir
            }

            if ($('#chk-kota-produk').is(':checked')) {
                data.id_kota = idKota
            }

            if ($('#chk-propinsi-produk').is(':checked')) {
                data.id_propinsi = idPropinsi
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>dashboard/stat_produk",
                data: data,
                cache: false,
                beforeSend: function() {
                    $('#dasbor-table-produk').block(blockUICfg)

                    if ($.fn.DataTable.isDataTable('#dasbor-table-produk')) {
                        dasborTableProduk.clear().destroy()
                    }
                },
                success: function(data) {
                    let nama_produk = []
                    let jumlah_produk = []

                    if (data.length > 0) {

                        let rows = ''
                        data.forEach((element, index) => {
                            rows += `<tr>
                                <td>${element.nama_barang}</td>
                                <td>${element.jumlah}</td>
                            </tr>`
                        });

                        $('#dasbor-table-produk tbody').html(rows)

                        nama_produk = data.map(item => {
                            return item.nama_barang
                        })

                        jumlah_produk = data.map(item => {
                            return item.jumlah
                        })

                        console.log(nama_produk)
                        console.log(jumlah_produk)
                    }

                    updateChartProduk(nama_produk, jumlah_produk)
                },
                complete: function() {
                    dasborTableProduk = $('#dasbor-table-produk').DataTable(tableCfg)
                    $('#dasbor-table-produk').unblock()
                }
            })
        }

        const colorProspekCfg = ['#3498db', '#2ecc71', '#1abc9c']
        const colorKesimpulanCfg = ['#2ecc71', '#e74c3c', '#e67e22', '#34495e']

        var ctxOpProspek = document.getElementById('chart-prospek-op').getContext('2d');
        var ctxOpKesimpulan = document.getElementById('chart-kesimpulan-op').getContext('2d');

        // https://stackoverflow.com/questions/52044013/chartjs-datalabels-show-percentage-value-in-pie-piece
        var labelOptionsPie = {
            tooltips: {
                enabled: false
            },
            plugins: {
                datalabels: {
                    // display: 'auto',
                    formatter: (value, ctx) => {

                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;

                        // return ctx.chart.data.labels[ctx.dataIndex];
                    },
                    color: '#fff',
                }
            }
        }

        var opProspekChart = new Chart(ctxOpProspek, {
            type: 'pie',
            data: {
                labels: ['Follow Up', 'Maintenance', 'Scale Up'],
                datasets: []
            },
            options: labelOptionsPie
        });

        var opKesimpulanChart = new Chart(ctxOpKesimpulan, {
            type: 'pie',
            data: {
                labels: ['Potensial', 'Tidak Potensial', 'Tidak Diketahui', 'Tidak Respon'],
                datasets: []
            },
            options: labelOptionsPie
        });

        function chartOpIndividu(data, row_index) {
            dataProspek = [data.follow_up, data.maintenance, data.scale_up]
            dataKesimpulan = [data.potensial, data.tidak_potensial, data.tidak_diketahui, data.tidak_respon]

            updateChartOp(opProspekChart, dataProspek, colorProspekCfg)
            updateChartOp(opKesimpulanChart, dataKesimpulan, colorKesimpulanCfg)

            $('#dasbor-table-op tbody tr').removeClass('table-success')
            $('#dasbor-table-op tbody tr').eq(row_index).addClass('table-success')
        }

        function updateChartOp(chart_obj, data, background) {
            const dataset_ = [{
                data: data,
                backgroundColor: background
            }];

            chart_obj.data.datasets = dataset_

            chart_obj.update()
        }

        var ctxProduk = document.getElementById('chart-produk').getContext('2d');
        var produkChart = new Chart(ctxProduk, {
            type: 'bar',
            labels: [],
            data: {
                datasets: []
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'x-axis',
                    xPadding: 20,
                    yPadding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function label(tooltipItem) {
                            return produkChart.data.labels[tooltipItem.index] + " - " + tooltipItem.yLabel;
                        },
                        title: function title() {
                            return null;
                        }
                    }
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            show: true,
                            labelString: 'Produk'
                        },
                        ticks: {
                            fontStyle: 600
                        },
                    }],
                    yAxes: [{
                        scaleLabel: {
                            show: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            fontStyle: 600,
                            beginAtZero: true
                        },
                    }]
                },
            }
        });

        function updateChartProduk(label, data) {
            const dataset_ = [{
                data: data,
                backgroundColor: '#0183d0',
            }];

            produkChart.data.labels = label
            produkChart.data.datasets = dataset_

            produkChart.update()
        }

        // function fmtOption(data) {
        //     var $container = $(
        //         "<div style='display:block; width:600px; height:100px'>" +
        //         "<p>" + data.nama_customer + " (" + data.telp_customer + ")</p>" +
        //         "<p>" + data.nama_kota + ", " + data.nama_propinsi + "</p>" +
        //         "</div>"
        //     );

        //     return $container;
        // }

        // function fmtSelect(data) {
        //     return data.nama_customer;
        // }
    </script>

</body>

</html>