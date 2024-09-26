<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function cari_customer()
    {
        header("Content-Type: application/json");

        $cari = $this->input->get('term');

        $result = [];

        $data = $this->db->query("SELECT
				aa.*, nama_kota, nama_propinsi
			FROM
				tbl_customer aa
			LEFT JOIN tbl_kota bb 
				ON aa.id_kabupaten = bb.id_kota
			LEFT JOIN tbl_propinsi cc
				ON bb.id_propinsi = cc.id_propinsi
			WHERE
				status_customer = 'Y'
			    AND (nama_customer LIKE '%" . $cari . "%' OR telp_customer LIKE '%" . $cari . "%') 
			GROUP BY
				aa.id_customer")->result();

        if (sizeof($data) > 0) {
            $result = $data;
        }

        echo json_encode($result);
    }

    function stat_beli()
    {
        header("Content-Type: application/json");

        $id_customer = $this->input->post('id_customer') ?? 0;

        $filter_customer = '';
        if ((int)$id_customer != 0) {
            $filter_customer = " AND aa.id_customer = " . $id_customer;
        }

        $result = [];

        $data = $this->db->query("SELECT tahun, bulan, COUNT(id_riwayat_beli) AS jumlah
            FROM (
                SELECT tahun, bulan
                FROM
                    (SELECT YEAR(CURDATE()) tahun UNION ALL SELECT YEAR(CURDATE())-1) tahun_,
                    (SELECT 1 bulan UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
                    UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8
                    UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12) bulan_) tahunbulan
            LEFT JOIN tbl_riwayat_beli aa
                ON tahunbulan.tahun = YEAR(aa.tgl_riwayat_beli)
                    AND tahunbulan.bulan = MONTH(aa.tgl_riwayat_beli) " .
            $filter_customer . "
            WHERE
                (tahun = YEAR(CURDATE()) AND bulan <= MONTH(CURDATE()))
                OR
                (tahun < YEAR(CURDATE()) AND bulan > MONTH(CURDATE()))
            GROUP BY tahun, bulan")->result();

        $result = $data;
        echo json_encode($result);
    }

    function stat_produk()
    {
        header("Content-Type: application/json");

        $tgl_awal_beli = $this->input->post('tgl_awal');
        $tgl_akhir_beli = $this->input->post('tgl_akhir');
        // $tgl_awal_beli = '2021-08-01';
        // $tgl_akhir_beli = '2021-11-30';
        $id_kota = $this->input->post('id_kota') ?? 0;
        $id_propinsi = $this->input->post('id_propinsi') ?? 0;

        $filter_kota = '';
        if ((int)$id_kota != 0) {
            $filter_kota = " AND bb.id_kabupaten = " . $id_kota;
        }

        $filter_propinsi = '';
        if ((int)$id_propinsi != 0) {
            $filter_propinsi = " AND bb.id_propinsi = " . $id_propinsi;
        }

        $result = [];

        $id_beli = $this->db->query("SELECT id_riwayat_beli
            FROM tbl_riwayat_beli aa
            LEFT JOIN tbl_customer bb
                ON aa.id_customer = bb.id_customer
            WHERE DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal_beli . "' AND '" . $tgl_akhir_beli . "'".
            $filter_kota .
            $filter_propinsi)->result();

        if (sizeof($id_beli) > 0) {
            $id_beli_join = array_reduce($id_beli, function ($x, $y) {
				return $x .','. $y->id_riwayat_beli;
			});
            $id_beli_join = substr($id_beli_join, 1);

            $data = $this->db->query("SELECT
                    nama_barang,
                    sum(jml_detail) AS jumlah
                FROM
                    tbl_riwayat_beli_detail trbd
                LEFT JOIN tbl_barang tb 
                ON
                    trbd.id_barang = tb.id_barang
                WHERE
                    id_riwayat_beli IN(".$id_beli_join.")
                GROUP BY tb.id_barang
                ORDER BY jumlah DESC
                LIMIT 10")->result();

            $result = $data;
        }

        echo json_encode($result);
    }

    function stat_customer()
    {
        header("Content-Type: application/json");

        $tgl_awal_beli = $this->input->post('tgl_awal_beli');
        $tgl_akhir_beli = $this->input->post('tgl_akhir_beli');
        $tgl_awal_penawaran = $this->input->post('tgl_awal_penawaran');
        $tgl_akhir_penawaran = $this->input->post('tgl_akhir_penawaran');
        $id_kota = $this->input->post('id_kota') ?? 0;
        $id_propinsi = $this->input->post('id_propinsi') ?? 0;
        $cari = $this->input->post('cari');

        $filter_tgl_beli = '';
        if ($tgl_awal_beli != '' && $tgl_akhir_beli != '') {
            $filter_tgl_beli = " AND DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal_beli . "' AND '" . $tgl_akhir_beli . "'";
        }

        $filter_tgl_penawaran = '';
        if ($tgl_awal_penawaran != '' && $tgl_akhir_penawaran != '') {
            $filter_tgl_penawaran = " AND DATE(tgl_penawaran) BETWEEN '" . $tgl_awal_penawaran . "' AND '" . $tgl_akhir_penawaran . "'";
        }

        $filter_kota = '';
        if ((int)$id_kota != 0) {
            $filter_kota = " AND aa.id_kabupaten = " . $id_kota;
        }

        $filter_propinsi = '';
        if ((int)$id_propinsi != 0) {
            $filter_propinsi = " AND bb.id_propinsi = " . $id_propinsi;
        }

        $result = [];

        $data = $this->db->query("SELECT
				aa.*, nama_kota, nama_propinsi, id_penawaran,
				MAX(tgl_penawaran) AS tgl_penawaran,
				max(tgl_riwayat_beli) AS tgl_beliterakhir
			FROM
				tbl_customer aa
			LEFT JOIN tbl_kota bb 
				ON aa.id_kabupaten = bb.id_kota
			LEFT JOIN tbl_propinsi cc
				ON bb.id_propinsi = cc.id_propinsi
			LEFT JOIN tbl_penawaran dd
				ON aa.id_customer = dd.id_customer
					AND status_penawaran = 'Y'
			LEFT JOIN tbl_riwayat_beli ff
				ON aa.id_customer = ff.id_customer 
			WHERE
				status_customer = 'Y'" .
            $filter_kota .
            $filter_propinsi .
            $filter_tgl_beli .
            $filter_tgl_penawaran .
            " AND (nama_customer LIKE '%" . $cari . "%' OR telp_customer LIKE '%" . $cari . "%') 
			GROUP BY
				aa.id_customer")->result();

        if (sizeof($data) > 0) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $id_customer = $data[$i]->id_customer;
                $sublist = $this->db->query("SELECT
                                tgl_riwayat_beli
                            FROM
                                tbl_riwayat_beli
                            WHERE
                                id_customer = " . $id_customer .
                    " AND status_riwayat_beli = 'Y'
                            ORDER BY tgl_riwayat_beli DESC")->result();
                $data[$i]->jumlah_beli = sizeof($sublist);

                $data[$i]->riwayat = $sublist;
            }

            $result = $data;
        }

        echo json_encode($result);
    }

    function stat_penawaran()
    {
        header("Content-Type: application/json");

        $tgl_awal_beli = $this->input->post('tgl_awal_beli');
        $tgl_akhir_beli = $this->input->post('tgl_akhir_beli');
        $tgl_awal_penawaran = $this->input->post('tgl_awal_penawaran');
        $tgl_akhir_penawaran = $this->input->post('tgl_akhir_penawaran');
        $id_kota = $this->input->post('id_kota') ?? 0;
        $id_propinsi = $this->input->post('id_propinsi') ?? 0;
        $cari = $this->input->post('cari');

        $filter_tgl_beli = '';
        if ($tgl_awal_beli != '' && $tgl_akhir_beli != '') {
            $filter_tgl_beli = " AND DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal_beli . "' AND '" . $tgl_akhir_beli . "'";
        }

        $filter_tgl_penawaran = '';
        if ($tgl_awal_penawaran != '' && $tgl_akhir_penawaran != '') {
            $filter_tgl_penawaran = " AND DATE(tgl_penawaran) BETWEEN '" . $tgl_awal_penawaran . "' AND '" . $tgl_akhir_penawaran . "'";
        }

        $filter_kota = '';
        if ((int)$id_kota != 0) {
            $filter_kota = " AND aa.id_kabupaten = " . $id_kota;
        }

        $filter_propinsi = '';
        if ((int)$id_propinsi != 0) {
            $filter_propinsi = " AND bb.id_propinsi = " . $id_propinsi;
        }

        $result = [];

        $data = $this->db->query("SELECT
				aa.*, nama_kota, nama_propinsi, id_penawaran,
				MAX(tgl_penawaran) AS tgl_penawaran,
				max(tgl_riwayat_beli) AS tgl_beliterakhir
			FROM
				tbl_penawaran aa
			LEFT JOIN tbl_customer bb
				ON aa.id_customer = bb.id_customer
			LEFT JOIN tbl_kota cc 
				ON bb.id_kabupaten = cc.id_kota
			LEFT JOIN tbl_propinsi dd
				ON cc.id_propinsi = dd.id_propinsi
			LEFT JOIN tbl_riwayat_beli ff
				ON bb.id_customer = ff.id_customer 
			WHERE
				status_customer = 'Y'" .
            $filter_kota .
            $filter_propinsi .
            $filter_tgl_beli .
            $filter_tgl_penawaran .
            " AND (nama_customer LIKE '%" . $cari . "%' OR telp_customer LIKE '%" . $cari . "%') 
			GROUP BY
				aa.id_customer")->result();

        $result = $data;
        echo json_encode($result);
    }

    function pembelian_per_kota()
    {
        header("Content-Type: application/json");

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $data = $this->db->query("SELECT
                nama_kota,
                nama_customer,
                MAX(jml_beli) AS jml_beli
            FROM
                (
                    SELECT
                        COUNT(id_riwayat_beli) AS jml_beli,
                        id_customer,
                        id_kabupaten
                    FROM
                        tbl_riwayat_beli aa
                    LEFT JOIN tbl_customer bb ON
                        aa.id_customer = bb.id_customer
                    WHERE
                        date(tgl_riwayat_beli) BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'
                    GROUP BY aa.id_customer
                ) beli
            LEFT JOIN tbl_kota aa
                ON beli.id_kabupaten = aa.id_kota
            GROUP BY id_kabupaten
            ORDER BY jml_beli DESC")->result();

        $result = $data;

        echo json_encode($result);
    }

    function pembelian_per_kota_beta2()
    {
        header("Content-Type: application/json");

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        // $tgl_awal = '2021-01-01';
        // $tgl_akhir = '2021-08-30';
        $result = array();

        $data = $this->db->query(" SELECT id_kabupaten 
            FROM tbl_customer 
            WHERE status_customer = 'Y' 
                AND id_kabupaten IS NOT NULL 
            GROUP BY id_kabupaten")->result();

        for ($i = 0; $i < sizeof($data); $i++) {
            $max_beli = $this->db->query("SELECT
                    aa.id_customer,
                    id_kabupaten,
                    nama_customer,
                    nama_kota,
                    COUNT(id_riwayat_beli) AS jml_beli
                FROM
                    tbl_riwayat_beli aa 
                    LEFT JOIN tbl_customer bb
                        ON aa.id_customer = bb.id_customer
                    LEFT JOIN tbl_kota cc
                        ON bb.id_kabupaten = cc.id_kota
                WHERE
                    DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'
                    AND id_kabupaten = " . $data[$i]->id_kabupaten . "
                GROUP BY aa.id_customer
                ORDER BY jml_beli DESC
                LIMIT 1")->result();

            if (sizeof($max_beli) > 0) {
                array_push($result, $max_beli[0]);
            }
        }

        echo json_encode($result);
    }


    function pembelian_per_propinsi()
    {
        header("Content-Type: application/json");

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $data = $this->db->query("SELECT
                nama_propinsi,
                nama_customer,
                MAX(jml_beli) AS jml_beli
            FROM
                (
                    SELECT
                        COUNT(id_riwayat_beli) AS jml_beli,
                        nama_customer,
                        id_propinsi
                    FROM
                        tbl_riwayat_beli aa
                    LEFT JOIN tbl_customer bb ON
                        aa.id_customer = bb.id_customer
                    WHERE
                        DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'
                    GROUP BY aa.id_customer
                ) beli
            LEFT JOIN tbl_propinsi aa
                ON beli.id_propinsi = aa.id_propinsi
            GROUP BY beli.id_propinsi
            ORDER BY jml_beli DESC")->result();

        $result = $data;

        echo json_encode($result);
    }

    function pembelian_per_propinsi_beta2()
    {
        header("Content-Type: application/json");

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        // $tgl_awal = '2021-01-01';
        // $tgl_akhir = '2021-08-30';
        $result = array();

        $data = $this->db->query(" SELECT id_propinsi 
            FROM tbl_customer 
            WHERE status_customer = 'Y' 
                AND id_propinsi IS NOT NULL 
            GROUP BY id_propinsi")->result();

        for ($i = 0; $i < sizeof($data); $i++) {
            $max_beli = $this->db->query("SELECT
                    aa.id_customer,
                    bb.id_propinsi,
                    nama_customer,
                    nama_propinsi,
                    COUNT(id_riwayat_beli) AS jml_beli
                FROM
                    tbl_riwayat_beli aa 
                    LEFT JOIN tbl_customer bb
                        ON aa.id_customer = bb.id_customer
                    LEFT JOIN tbl_propinsi cc
                        ON bb.id_propinsi = cc.id_propinsi
                WHERE
                    DATE(tgl_riwayat_beli) BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'
                    AND bb.id_propinsi = " . $data[$i]->id_propinsi . "
                GROUP BY aa.id_customer
                ORDER BY jml_beli DESC
                LIMIT 1")->result();

            if (sizeof($max_beli) > 0) {
                array_push($result, $max_beli[0]);
            }
        }

        echo json_encode($result);
    }

    function stat_operator()
    {
        header("Content-Type: application/json");

        $tgl_awal_penawaran = $this->input->post('tgl_awal_penawaran');
        $tgl_akhir_penawaran = $this->input->post('tgl_akhir_penawaran');
        $cari = $this->input->post('cari');

        $filter_tgl_penawaran = '';
        if ($tgl_awal_penawaran != '' && $tgl_akhir_penawaran != '') {
            $filter_tgl_penawaran = " AND DATE(tgl_penawaran) BETWEEN '" . $tgl_awal_penawaran . "' AND '" . $tgl_akhir_penawaran . "'";
        }

        $result = [];

        $data = $this->db->query("SELECT
                nama_operator,
                sum(prospek_penawaran = 'follow up') AS follow_up,
                sum(prospek_penawaran = 'maintenance') AS maintenance,
                sum(prospek_penawaran = 'scale up') AS scale_up,
                sum(kesimpulan_penawaran = 'potensial') AS potensial,
                sum(kesimpulan_penawaran = 'tidak potensial') AS tidak_potensial,
                sum(kesimpulan_penawaran = 'tidak diketahui') AS tidak_diketahui,
                sum(kesimpulan_penawaran = 'tidak respon') AS tidak_respon,
                count(id_penawaran) AS total_penawaran
            FROM
                tbl_penawaran aa
            LEFT JOIN tbl_operator bb
                ON aa.id_operator = bb.id_operator
            WHERE
                status_penawaran = 'Y'
                AND aa.id_operator IS NOT NULL " .
            $filter_tgl_penawaran .
            " AND nama_operator LIKE '%" . $cari . "%' 
            GROUP BY
        aa.id_operator")->result();

        $result = $data;
        echo json_encode($result);
    }

    function riwayat_beli()
    {
        header("Content-Type: application/json");

        $id_customer = $this->input->post('id_customer') ?? 0;
        $bulan_tahun = explode('/', $this->input->post('bulan_tahun'));
        $bulan = $bulan_tahun[0];
        $tahun = $bulan_tahun[1];

        $filter_customer = '';
        if ((int)$id_customer != 0) {
            $filter_customer = " AND aa.id_customer = " . $id_customer;
        }

        $data = $this->db->query("SELECT
                id_riwayat_beli, nama_customer,
                tgl_riwayat_beli, ekspedisi, grand_total
            FROM
                tbl_riwayat_beli aa
                LEFT JOIN tbl_customer bb
                    ON aa.id_customer = bb.id_customer
            WHERE
                status_riwayat_beli = 'Y'
                AND MONTH(tgl_riwayat_beli) = " . $bulan . "
                AND YEAR(tgl_riwayat_beli) = " . $tahun .
            $filter_customer .
            " ORDER BY tgl_riwayat_beli DESC")->result();


        for ($i = 0; $i < sizeof($data); $i++) {
            $id_riwayat_beli = $data[$i]->id_riwayat_beli;
            $data[$i]->item_riwayat_beli = '';

            $sublist = $this->db->query("SELECT
                                nama_barang, jml_detail
                            FROM
                                tbl_riwayat_beli_detail aa
                                LEFT JOIN tbl_barang bb 
                                    ON aa.id_barang = bb.id_barang
                            WHERE
                                id_riwayat_beli = " . $id_riwayat_beli)->result();


            foreach ($sublist as $s) {
                $data[$i]->item_riwayat_beli = $data[$i]->item_riwayat_beli .
                    $s->nama_barang . ' x' . $s->jml_detail . ', ';
            }

            $data[$i]->item_riwayat_beli = substr($data[$i]->item_riwayat_beli, 0, -2);
        }

        $result = $data;

        echo json_encode($result);
    }
}
