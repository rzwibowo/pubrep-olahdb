<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as pw;

class Master_customer extends CI_Controller
{
	function customer($page = 0, $cari = null)
	{
		cek_session_admin();

		$page_ = $page;
		$cari_ = '';

		if ($cari) {
			$cari_ = urldecode($cari);
		}

		$this->db->select("id_customer");
		$this->db->from("tbl_customer");
		$this->db->where("status_customer", "Y");
		$total_data = $this->db->count_all_results();

		$data = $this->db->query("SELECT aa.*, nama_kota, nama_propinsi
                                FROM tbl_customer aa
								LEFT JOIN tbl_kota bb ON aa.id_kabupaten = bb.id_kota                 
								LEFT JOIN tbl_propinsi cc ON aa.id_propinsi = cc.id_propinsi                 
                                WHERE status_customer = 'Y'
								AND nama_customer LIKE '%" . $cari_ . "%'
								ORDER BY waktu_input DESC
								LIMIT 100 OFFSET " . (int)$page_ * 100)->result();

		$data = array(
			'customer' => $data,
			'cari' => $cari_,
			'page' => $page_,
			'total' => $total_data
		);

		$this->load->view('app/mod_customer/customer', $data);
	}


	function cari_ajax()
	{
		$cari        	= $this->input->post('cari');
		$data = $this->db->query("SELECT l.nama_level, o.*
                                FROM tbl_operator o
								LEFT JOIN tbl_level l ON o.id_level = l.id_level                               
                                WHERE o.status_operator = 'Y' 
								AND o.nama_operator like '%" . $cari . "%'
								ORDER BY o.nama_operator ASC");
		$data = array('operator' => $data);
		$this->load->view('app/mod_operator/cari_ajax', $data);
	}

	function customer_tambah()
	{
		cek_session_admin();
		$tanggal    = date('Y-m-d H:i:s');
		if (isset($_POST['submit_customer'])) {
			$data = array(
				'nama_customer' => $this->input->post('nama_customer'),
				'telp_customer' => $this->input->post('telp_customer'),
				'alamat_customer' => $this->input->post('alamat_customer'),
				'kodepos' => $this->input->post('kodepos'),
				'id_propinsi' => $this->input->post('id_propinsi'),
				'id_kabupaten' => $this->input->post('id_kota'),
				'waktu_input' => $tanggal,
				'id_operator' => $this->session->id_operator
			);
			$insert = $this->db->insert('tbl_customer', $data);

			if ($insert) {
				redirect('master_customer/customer');
			} else {
				// $data_result->status = 'save-err';
			}
		} else {
			$data['propinsi'] = $this->model_app->view_where_asc(
				'tbl_propinsi',
				array('status_propinsi' => 'Y'),
				'nama_propinsi'
			);
			// $this->load->view('app/mod_customer/customer_tambah', $data);
			$this->load->view('app/mod_customer/customer_tambah', $data);
		}
	}

	function customer_edit()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit_customer'])) {
			$data = array(
				'nama_customer' => $this->input->post('nama_customer'),
				'telp_customer' => $this->input->post('telp_customer'),
				'alamat_customer' => $this->input->post('alamat_customer'),
				'kodepos' => $this->input->post('kodepos'),
				'id_propinsi' => $this->input->post('id_propinsi'),
				'id_kabupaten' => $this->input->post('id_kota'),
			);

			if (!empty($this->input->post('kota_csv_customer')) && !empty($this->input->post('id_kota'))) {
				$data['error_kota_customer'] = 'N';
			}

			$where = array('id_customer' => $this->input->post('id_customer'));
			$this->model_app->update('tbl_customer', $data, $where);
			redirect('master_customer/customer');
		} else {
			$qry  = $this->model_app->edit('tbl_customer', array('id_customer' => $id))->row_array();
			$qry_propinsi = $this->model_app->view_where_asc(
				'tbl_propinsi',
				array('status_propinsi' => 'Y'),
				'nama_propinsi'
			);
			$data = array('customer' => $qry, 'propinsi' => $qry_propinsi);
			$this->load->view('app/mod_customer/customer_edit', $data);
		}
	}

	function customer_hapus()
	{
		$id    = $this->input->post('id_customer');
		$where = array('id_customer' => $id);
		$data  = array('status_customer' => 'N');
		$this->model_app->update('tbl_customer', $data, $where);
	}

	function customer_hapus_batch()
	{
		$id    = $this->input->post('id_customers');
		$splitCustomer = explode(",", $id);

		$where = array();
		foreach ($splitCustomer as $c) {
			$in = array(
				"id_customer" => (int)$c,
				"status_customer" => "N"
			);
			array_push($where, $in);
		}

		// print_r($where);
		$this->db->update_batch('tbl_customer', $where, "id_customer");
	}

	function customer_import()
	{
		cek_session_admin();
		cek_session_cs();
		$this->load->view('app/mod_customer/customer_import');
	}

	function upload_xl()
	{
		header("Content-Type: application/json");
		$tanggal    = date('Y-m-d H:i:s');
		$data_result = new stdClass();

		$file = $_FILES['file']['tmp_name'];
		$nama_file = $_FILES['file']['name'];
		// Medapatkan ekstensi file csv yang akan diimport.
		$tipe = $_FILES['file']['type'];

		$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if (isset($nama_file) && in_array($tipe, $file_mimes)) {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

			$reader->setReadDataOnly(true);
			$reader->setReadEmptyCells(false);

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();

			$temp_id_customer = 0;
			$temp_tgl_trx = '';

			// hitung berapa yg diinsert, diupdate, dan error
			$ins = 0;
			$upd = 0;
			$err = 0;
			for ($i = 1; $i < count($sheetData); $i++) {
				// Data yang akan disimpan ke dalam databse
				$data = [
					'nama_customer' => $sheetData[$i][0],
					'telp_customer' => $sheetData[$i][1],
					'alamat_customer' => $sheetData[$i][2],
					'kodepos' => $sheetData[$i][5],
					'waktu_input' => $tanggal,
					'id_operator' => $this->session->id_operator
				];

				$data_trx = [
					'tgl_riwayat_beli' => $sheetData[$i][6],
					'ekspedisi' => $sheetData[$i][7],
					'grand_total' => $sheetData[$i][10],
					'waktu_input' => $tanggal,
				];

				$data_barang = [
					'nama_barang' => $sheetData[$i][8],
					'waktu_input' => $tanggal,
				];

				$data_trx_detail = [
					'jml_detail' => $sheetData[$i][9],
					'subtotal' => $sheetData[$i][10],
					'waktu_input' => $tanggal,
				];

				$data_cs = array(
					'nama_karyawan' => $sheetData[$i][11],
					'telp_karyawan' => $sheetData[$i][12],
					'waktu_input' => $tanggal,
					'id_operator' => $this->session->id_operator
				);

				$kota = $sheetData[$i][3];

				// validasi tiap kolom
				$validasi = $this->validasi_data_xl($data, $data_trx, $data_barang, $data_trx_detail, $data_cs, $kota);

				if ($validasi['is_valid'] == true) {
					$cari_kota = $this->db->query("SELECT id_kota, id_propinsi 
								FROM tbl_kota
								WHERE LOWER(TRIM(REPLACE(nama_kota, ' ',''))) = '" .
						strtolower(trim(str_replace(' ', '', $kota))) .
						"'")->result();

					if (sizeof($cari_kota) > 0) {
						$data['id_kabupaten'] = $cari_kota[0]->id_kota;
						$data['id_propinsi'] = $cari_kota[0]->id_propinsi;
					} else {
						$data['kota_csv_customer'] = $kota;
						$data['error_kota_customer'] = 'Y';
					}

					$cari_barang = $this->db->query("SELECT id_barang 
								FROM tbl_barang
								WHERE LOWER(TRIM(REPLACE(nama_barang, ' ',''))) = '" .
						strtolower(trim(str_replace(' ', '', $data_barang['nama_barang']))) .
						"'")->result();

					if (sizeof($cari_barang) > 0) {
						$data_trx_detail['id_barang'] = $cari_barang[0]->id_barang;
					} else {
						$this->db->insert('tbl_barang', $data_barang);
						$data_trx_detail['id_barang'] = $this->db->insert_id();
					}

					$cari_cs = $this->db->query("SELECT id_karyawan 
								FROM tbl_karyawan
								WHERE telp_karyawan = '" . $data_cs['telp_karyawan'] . "'")->result();

					if (sizeof($cari_cs) > 0) {
						$data['id_karyawan'] = $cari_cs[0]->id_karyawan;
					} else {
						$this->db->insert('tbl_karyawan', $data_cs);
						$data['id_karyawan'] = $this->db->insert_id();
					}

					$cari_customer = $this->db->query("SELECT id_customer 
								FROM tbl_customer
								WHERE telp_customer = '" . $data['telp_customer'] . "'")->result();

					// Simpan data ke database.
					$id_customer = 0;
					if (sizeof($cari_customer) > 0) {
						$id_customer = $cari_customer[0]->id_customer;

						$data['status_customer'] = 'Y';
						$where = array('id_customer' => $id_customer);

						$cari_penawaran = $this->db->query("SELECT MAX(tgl_penawaran) AS tgl_terakhir
								FROM tbl_penawaran
								WHERE id_customer = " . $id_customer)->result();

						if (sizeof($cari_penawaran) > 0) {
							//tgl beli lebih dari tgl penawaran, tambah flag sukses
							if (strtotime($data_trx['tgl_riwayat_beli']) > strtotime($cari_penawaran[0]->tgl_terakhir)) {
								$data['status_follow_up'] = 'Y';
							}
						}

						$this->model_app->update('tbl_customer', $data, $where);
						$upd++;
					} else {
						$this->db->insert('tbl_customer', $data);
						$ins++;

						$id_customer = $this->db->insert_id();
					}

					$data_trx['id_customer'] = $id_customer;

					$cari_trx = $this->db->query("SELECT id_riwayat_beli, grand_total
								FROM tbl_riwayat_beli
								WHERE DATE(tgl_riwayat_beli) = '" . $data_trx['tgl_riwayat_beli'] . "'
									AND id_customer = " . $data_trx['id_customer'])->result();

					if (sizeof($cari_trx) == 0) {
						$this->db->insert('tbl_riwayat_beli', $data_trx);
						$data_trx_detail['id_riwayat_beli'] = $this->db->insert_id();
					}

					if ($i >= 2) {
						if ($id_customer == $temp_id_customer && $data_trx['tgl_riwayat_beli'] == $temp_tgl_trx) {
							$data_trx_detail['id_riwayat_beli'] = $cari_trx[0]->id_riwayat_beli;

							$grand_total = (int)$cari_trx[0]->grand_total + (int)$data_trx_detail['subtotal'];
							$data_grand_total = array('grand_total' => $grand_total);
							$where_trx = array('id_riwayat_beli' => $cari_trx[0]->id_riwayat_beli);
							$this->model_app->update('tbl_riwayat_beli', $data_grand_total, $where_trx);
						}
					}

					$this->db->insert('tbl_riwayat_beli_detail', $data_trx_detail);

					$temp_id_customer = $id_customer;
					$temp_tgl_trx = $data_trx['tgl_riwayat_beli'];
				} else {
					$err++;
					$data_customer_error = array(
						'tgl_impor' => $tanggal,
						'detail_error' => json_encode($sheetData[$i]),
						'pesan_error' => $validasi['msg']
					);
					$this->db->insert('tbl_customer_error', $data_customer_error);
				}
			}

			$data_result->status = 'save-ok';
			$data_result->rows_ins = $ins;
			$data_result->rows_upd = $upd;
			$data_result->rows_err = $err;
		} else {
			$data_result->status = 'save-err';
		}

		echo json_encode($data_result);
	}

	private function validasi_data_xl($data_customer, $data_trx, $data_barang, $data_trx_detail, $data_cs, $kota)
	{
		$validasi = array();
		$msg = '';

		#region CEK DATA CUSTOMER
		if (
			strlen(trim($data_customer['nama_customer'])) < 1
			|| !preg_match('/[a-zA-Z]/', $data_customer['nama_customer'])
		) {
			array_push($validasi, false);
			$msg .= 'Nama customer tidak boleh kosong dan minimal memuat 1 huruf. ';
		}

		if (
			strlen(trim($data_customer['telp_customer'])) < 1
			|| !preg_match('/\d/', $data_customer['telp_customer'])
		) {
			array_push($validasi, false);
			$msg .= 'Telepon customer tidak boleh kosong dan hanya bisa memuat angka. ';
		}

		if (
			strlen(trim($data_customer['alamat_customer'])) < 1
			|| !preg_match('/[a-zA-Z]/', $data_customer['alamat_customer'])
		) {
			array_push($validasi, false);
			$msg .= 'Telepon customer tidak boleh kosong dan minimal memuat 1 huruf. ';
		}
		#endregion CEK DATA CUSTOMER

		#region CEK DATA TRX
		if (
			strlen(trim($data_trx['tgl_riwayat_beli'])) < 1
			|| !preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $data_trx['tgl_riwayat_beli'])
		) {
			array_push($validasi, false);
			$msg .= 'Tanggal transaksi tidak boleh kosong dan harus berformat YYYY-MM-DD. ';
		}

		if (
			strlen(trim($data_trx['ekspedisi'])) < 1
			|| !preg_match('/[a-zA-Z]/', $data_trx['ekspedisi'])
		) {
			array_push($validasi, false);
			$msg .= 'Ekspedisi tidak boleh kosong dan minimal memuat 1 huruf. ';
		}

		if (
			strlen(trim($data_trx['grand_total'])) < 1
			|| !ctype_digit($data_trx['grand_total'])
		) {
			array_push($validasi, false);
			$msg .= 'Grand total tidak boleh kosong dan hanya bisa memuat angka. ';
		}
		#endregion CEK DATA TRX

		#region CEK DATA CS
		if (
			strlen(trim($data_cs['nama_karyawan'])) < 1
			|| !preg_match('/[a-zA-Z]/', $data_cs['nama_karyawan'])
		) {
			array_push($validasi, false);
			$msg .= 'Nama CS tidak boleh kosong dan minimal memuat 1 huruf. ';
		}

		if (
			strlen(trim($data_cs['telp_karyawan'])) < 1
			|| !preg_match('/\d/', $data_cs['telp_karyawan'])
		) {
			array_push($validasi, false);
			$msg .= 'No. HP CS tidak boleh kosong dan hanya bisa memuat angka. ';
		}
		#endregion CEK DATA CS

		#region CEK DATA BARANG
		if (
			strlen(trim($data_barang['nama_barang'])) < 1
			|| !preg_match('/[a-zA-Z]/', $data_barang['nama_barang'])
		) {
			array_push($validasi, false);
			$msg .= 'Nama Barang tidak boleh kosong dan minimal memuat 1 huruf. ';
		}
		#endregion CEK DATA BARANG

		#region CEK DATA TRX DETAIL
		if (
			strlen(trim((string)$data_trx_detail['jml_detail'])) < 1
			|| !is_int($data_trx_detail['jml_detail'])
		) {
			array_push($validasi, false);
			$msg .= 'Jumlah Item tidak boleh kosong dan hanya bisa memuat angka. ';
		}
		if (
			strlen(trim($data_trx_detail['subtotal'])) < 1
			|| !ctype_digit($data_trx_detail['subtotal'])
		) {
			array_push($validasi, false);
			$msg .= 'Subtotal tidak boleh kosong dan hanya bisa memuat angka. ';
		}
		#endregion CEK DATA TRX DETAIL

		#region CEK DATA KOTA
		if (
			strlen(trim($kota)) < 1
			|| !preg_match('/[a-zA-Z]/', $kota)
		) {
			array_push($validasi, false);
			$msg .= 'Kota tidak boleh kosong dan minimal memuat 1 huruf. ';
		}
		#endregion CEK DATA KOTA

		$result = array(
			'is_valid' => array_reduce($validasi, function ($x, $y) {
				return $x && $y;
			}, true),
			'msg' => $msg
		);

		return $result;
	}

	function error_log()
	{
		cek_session_admin();

		$data_log = $this->db->query("SELECT *
			FROM tbl_customer_error
			ORDER BY tgl_impor DESC")->result();

		$data = array('log' => $data_log);

		$this->load->view('app/mod_customer/error_log', $data);
	}

	function export_error_log()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		$sheet->setCellValue('A1', "CUSTOMER ERROR LOG"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "Nama Customer");
		$sheet->setCellValue('B3', "No. HP Customer");
		$sheet->setCellValue('C3', "Alamat");
		$sheet->setCellValue('D3', "Kota");
		$sheet->setCellValue('E3', "Propinsi");
		$sheet->setCellValue('F3', "Kode Pos");
		$sheet->setCellValue('G3', "Tgl. Transaksi");
		$sheet->setCellValue('H3', "Ekspedisi");
		$sheet->setCellValue('I3', "Produk");
		$sheet->setCellValue('J3', "Qty");
		$sheet->setCellValue('K3', "Subtotal");
		$sheet->setCellValue('L3', "Nama CS");
		$sheet->setCellValue('M3', "No. HP CS");
		$sheet->setCellValue('N3', "Keterangan");
		$sheet->setCellValue('O3', "Tgl. Impor");
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);
		$sheet->getStyle('L3')->applyFromArray($style_col);
		$sheet->getStyle('M3')->applyFromArray($style_col);
		$sheet->getStyle('N3')->applyFromArray($style_col);
		$sheet->getStyle('O3')->applyFromArray($style_col);
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$data_log = $this->db->query("SELECT *
			FROM tbl_customer_error
			ORDER BY tgl_impor DESC")->result();

		$numrow = 4;
		foreach ($data_log as $data) {
			$dataList = explode(",", substr($data->detail_error, 1, -1));

			$sheet->setCellValue('A' . $numrow, trim($dataList[0], "\""));
			$sheet->setCellValue('B' . $numrow, trim($dataList[1], "\""));
			$sheet->setCellValue('C' . $numrow, trim($dataList[2], "\""));
			$sheet->setCellValue('D' . $numrow, trim($dataList[3], "\""));
			$sheet->setCellValue('E' . $numrow, trim($dataList[4], "\""));
			$sheet->setCellValue('F' . $numrow, trim($dataList[5], "\""));
			$sheet->setCellValue('G' . $numrow, trim($dataList[6], "\""));
			$sheet->setCellValue('H' . $numrow, trim($dataList[7], "\""));
			$sheet->setCellValue('I' . $numrow, trim($dataList[8], "\""));
			$sheet->setCellValue('J' . $numrow, trim($dataList[9], "\""));
			$sheet->setCellValue('K' . $numrow, trim($dataList[10], "\""));
			$sheet->setCellValue('L' . $numrow, trim($dataList[11], "\""));
			$sheet->setCellValue('M' . $numrow, trim($dataList[12], "\""));
			$sheet->setCellValue('N' . $numrow, $data->pesan_error);
			$sheet->setCellValue('O' . $numrow, $data->tgl_impor);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('O' . $numrow)->applyFromArray($style_row);

			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('F')->setWidth(15);
		$sheet->getColumnDimension('G')->setWidth(15);
		$sheet->getColumnDimension('H')->setWidth(15);
		$sheet->getColumnDimension('I')->setWidth(15);
		$sheet->getColumnDimension('J')->setWidth(15);
		$sheet->getColumnDimension('K')->setWidth(15);
		$sheet->getColumnDimension('L')->setWidth(15);
		$sheet->getColumnDimension('M')->setWidth(15);
		$sheet->getColumnDimension('N')->setWidth(15);
		$sheet->getColumnDimension('O')->setWidth(15);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$sheet->setTitle("Customer Error Log");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Customer Error Log_' . date('Ymd') . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new pw\Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	function clear_error_log()
	{
		cek_session_admin();
		$this->db->query("DELETE FROM tbl_customer_error");
		redirect('master_customer/error_log');
	}
}
