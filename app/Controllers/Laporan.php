<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;
use DateTime;
use DateTimeZone;

class Laporan extends BaseController {

    // [ Index ] ==================================================================================================== //

		public function index() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/laporan');
				echo view('layout/_footer');
				
			}
			
		}

        public function view_pengeluaran() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$fetch['data_pengeluaran'] = $Schema -> visual_table('pengeluaran');

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/pengeluaran', $fetch);
				echo view('layout/_footer');
				
			}

        }

        public function view_pembelian() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();
				
					$on = 'supplier.id_produk = produk.id_produk';
					$fetch['data_restock'] = $Schema -> visual_table_join2('supplier', 'produk', $on);

					$on2 = 'pembelian_produk.id_supplier = supplier.id_supplier';
					$fetch['data_pembelian'] = $Schema -> visual_table_join2('pembelian_produk', 'supplier', $on2);

					// $fetch['data_pembelian'] = $Schema -> visual_table('pembelian_produk');
				
					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/pembelian', $fetch);
				echo view('layout/_footer');
				
			}

        }

        public function view_penjualan() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'penjualan.p_kode_member = member.id_member';
					$on2 = 'penjualan.kasir = user.id_user';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$fetch['penjualan_data'] = $Schema -> visual_table_join3('penjualan', 'member', 'user', $on, $on2);

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/penjualan', $fetch);
				echo view('layout/_footer');
				
			}

        }

        public function view_transaksi_lama() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/transaksi_lama');
				echo view('layout/_footer');
				
			}

        }

        public function view_transaksi_baru() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/laporan/transaksi_baru');
				echo view('layout/_footer');
				
			}

        }

	// [ CRUD supplier ] ==================================================================================================== //

		public function create_pengeluaran() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();
				
					$tanggal_pengeluaran = $this -> request -> getPost('tanggal_pengeluaran');
					$jenis_pengeluaran = $this -> request -> getPost('jenis_pengeluaran');
					$nominal_pengeluaran = $this -> request -> getPost('nominal');

						$data = $Schema -> create_data('pengeluaran', array(
							'tanggal_pengeluaran' => $tanggal_pengeluaran,
							'jenis_pengeluaran' => $jenis_pengeluaran,
							'nominal_pengeluaran' => $nominal_pengeluaran,
							'PENGELUARAN_createdBy' => session() -> get('id')
						));

				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Laporan/view_pengeluaran/?');
					
				}

			}

		}

		public function update_pengeluaran() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();
				
					$id_pengeluaran = $this -> request -> getPost('id');
					$tanggal_pengeluaran = $this -> request -> getPost('tanggal_pengeluaran');
					$jenis_pengeluaran = $this -> request -> getPost('jenis_pengeluaran');
					$nominal_pengeluaran = $this -> request -> getPost('nominal');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

						$data = $Schema -> update_data('pengeluaran', array(
							'tanggal_pengeluaran' => $tanggal_pengeluaran,
							'jenis_pengeluaran' => $jenis_pengeluaran,
							'nominal_pengeluaran' => $nominal_pengeluaran,
							'PENGELUARAN_updatedAt' => $date -> format('Y-m-d H:i:s'),
							'PENGELUARAN_updatedBy' => session() -> get('id')
						), array('id_pengeluaran' => $id_pengeluaran));

				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Laporan/view_pengeluaran/?');
					
				}

			}

		}

		public function delete_pengeluaran($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('pengeluaran', array('id_pengeluaran' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/Laporan/view_pengeluaran/?');

				}

			}

		}

}