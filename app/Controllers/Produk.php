<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

use DateTime;
use DateTimeZone;

class Produk extends BaseController {

	// [ Index ] ==================================================================================================== //

		public function index() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'produk.kategori_produk = kategori.id_kategori';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$fetch['data_produk'] = $Schema -> visual_table_join2('produk', 'kategori', $on);
					$fetch['data_kategori'] = $Schema -> visual_table('kategori');
					$fetch['uniquecode'] = $Schema -> generateUniqueCode();

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/produk/produk', $fetch);
				echo view('layout/_footer');
				
			}
			
		}

		public function view_kategori() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$fetch['data_kategori'] = $Schema -> visual_table('kategori');

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/produk/kategori_produk', $fetch);
				echo view('layout/_footer');

			}

		}

	// [ CRUD - kategori ] ==================================================================================================== //

		public function create_kategori() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$kategori = $this -> request -> getPost('kategori');

						$data = $Schema -> create_data('kategori', array('kategori' => $kategori, 'KATEGORI_createdBy' => session() -> get('id')));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Produk/view_kategori/?');

				}

			}

		}

		public function update_kategori() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$kategori = $this -> request -> getPost('kategori');
					$id_kategori = $this -> request -> getPost('id');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

					$data = $Schema -> update_data('kategori', array(
						'kategori' => $kategori,
						'KATEGORI_updatedAt' => $date -> format('Y-m-d H:i:s'),
						'KATEGORI_updatedBy' => session() -> get('id')
					), array('id_kategori' => $id_kategori));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di perbaharui');

					return redirect() -> to('/Produk/view_kategori/?');

				}

			}

		}

		public function delete_kategori($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('kategori', array('id_kategori' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/Produk/view_kategori/?');

				}

			}

		}

	// [ CRUD - barang ] ==================================================================================================== //
	
		public function create_produk() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$kode_produk = $this -> request -> getPost('kode_produk');
					$nama_produk = $this -> request -> getPost('nama_produk');
					$merk_produk = $this -> request -> getPost('merk_produk');
					$kategori_produk = $this -> request -> getPost('kategori_produk');
					$harga_pembelian_produk = $this -> request -> getPost('harga_pembelian_produk');
					$harga_penjualan_produk = $this -> request -> getPost('harga_penjualan_produk');
					$diskon_produk = $this -> request -> getPost('diskon_produk');
					$stok_produk = $this -> request -> getPost('stok_produk');

						$data = $Schema -> create_data('produk', array(
							'kategori_produk' => $kategori_produk,
							'kode_produk' => $kode_produk,
							'nama_produk' => $nama_produk,
							'merk_produk' => $merk_produk,
							'harga_pembelian' => $harga_pembelian_produk,
							'harga_penjualan' => $harga_penjualan_produk,
							'diskon_produk' => $diskon_produk,
							'stok_produk' => $stok_produk,
							'PRODUK_createdBy' => session() -> get('id')
						));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Produk/?');

				}

			}

		}

		public function update_produk() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$nama_produk = $this -> request -> getPost('nama_produk');
					$merk_produk = $this -> request -> getPost('merk_produk');
					$kategori_produk = $this -> request -> getPost('kategori_produk');
					$harga_pembelian_produk = $this -> request -> getPost('harga_pembelian_produk');
					$harga_penjualan_produk = $this -> request -> getPost('harga_penjualan_produk');
					$diskon_produk = $this -> request -> getPost('diskon_produk');
					$stok_produk = $this -> request -> getPost('stok_produk');
					$id_produk = $this -> request -> getPost('id');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

					$data = $Schema -> update_data('produk', array(
						'kategori_produk' => $kategori_produk,
						'nama_produk' => $nama_produk,
						'merk_produk' => $merk_produk,
						'harga_pembelian' => $harga_pembelian_produk,
						'harga_penjualan' => $harga_penjualan_produk,
						'diskon_produk' => $diskon_produk,
						'stok_produk' => $stok_produk,
						'PRODUK_updatedAt' => $date -> format('Y-m-d H:i:s'),
						'PRODUK_updatedBy' => session() -> get('id')
					), array('id_produk' => $id_produk));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di perbaharui');

					return redirect() -> to('/Produk/?');

				}

			}

		}

		public function delete_produk($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('produk', array('id_produk' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/Produk/?');

				}

			}

		}

}