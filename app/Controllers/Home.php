<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

use DateTime;
use DateTimeZone;

class Home extends BaseController {

	// [ Views ] ==================================================================================================== //

		public function index() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return view('login');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['profile'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/dashboard');
				echo view('layout/_footer');
				
			}
			
		}

		public function dashboard() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/Home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['profile'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/dashboard');
				echo view('layout/_footer');

			}
		}

		public function view_member() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/Home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$fetch['data_member'] = $Schema -> visual_table('member');

					$setting['profile'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$fetch['uniquecode'] = $Schema -> generateUniqueCode();

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/more/member', $fetch);
				echo view('layout/_footer');

			}

		}

		public function view_supplier() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'supplier.id_produk = produk.id_produk';
					$fetch['data_supplier'] = $Schema -> visual_table_join2('supplier', 'produk', $on);
					$fetch['data_produk'] = $Schema -> visual_table('produk');

					$setting['profile'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/more/supplier', $fetch);
				echo view('layout/_footer');

			}

		}
		
	// [ Login & Logout Function ] ==================================================================================================== //

		public function authentication_login() {

            $Schema = new Schema();

                // Collecting data by " name " attribute from HTML document

					$username = $this -> request -> getPost('username');
					$password = $this -> request -> getPost('password');

                /**
                 * Filter a input username with email, if the input was an email then login with session of email
                 * else if the input was username then login with session of username

                 * Convert inputted data into an array, and find the data from database of " user " table
                */

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        
                        $_data = array('email' => $username, 'password' => md5($password));

                    } else {

                        $_data = array('username' => $username, 'password' => md5($password));

                    }
                    
                    $data_filter = $Schema -> getWhere2('user', $_data);

                // ==================================================================================================== //

                    if ($data_filter > 0) {

                        session() -> set('id', $data_filter['id_user']);
						session() -> set('username', $data_filter['username']);
                        session() -> set('email', $data_filter['email']);
						session() -> set('level', $data_filter['_level']);

						return redirect() -> to('/Home/dashboard');

                    } else {

						return redirect() -> to('/Home/');

                    };
            
        }

		public function authentication_logout() {

			session() -> destroy();

			return redirect() -> to('/Home/');

		}

	// [ CRUD member ] ==================================================================================================== //

		public function create_member() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/Home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$kode_member = $this -> request -> getPost('kode_member');
					$nama_member = $this -> request -> getPost('nama_member');
					$alamat_member = $this -> request -> getPost('alamat_member');
					$nomor_handphone_member = $this -> request -> getPost('nomor_handphone_member');

						$data = $Schema -> create_data('member', array(
							'kode_member' => $kode_member,
							'nama_member' => $nama_member,
							'alamat_member' => $alamat_member,
							'nomor_handphone_member' => '+62 ' . $nomor_handphone_member,
							'MBR_CreatedBy' => session() -> get('id')
						));

				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Home/view_member/?');
					
				}

			}

		}

		public function update_member() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$id_member = $this -> request -> getPost('id');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

					$kode_member = $this -> request -> getPost('kode_member');
					$nama_member = $this -> request -> getPost('nama_member');
					$alamat_member = $this -> request -> getPost('alamat_member');
					$nomor_handphone_member = $this -> request -> getPost('nomor_handphone_member');

						$data = $Schema -> update_data('member', array(
							'kode_member' => $kode_member,
							'nama_member' => $nama_member,
							'alamat_member' => $alamat_member,
							'nomor_handphone_member' => '+62 ' . $nomor_handphone_member,
							'MBR_UpdatedAt' => $date -> format('Y-m-d H:i:s'),
							'MBR_UpdatedBy' => session() -> get('id')
						), array('id_member' => $id_member));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di perbaharui');

					return redirect() -> to('/Home/view_member/?');
					
				}

			}

		}

		public function delete_member($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('member', array('id_member' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/Home/view_member/?');

				}

			}

		}

	// [ CRUD supplier ] ==================================================================================================== //

		public function create_supplier() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$produk = $this -> request -> getPost('produk');
					$nama_supplier = $this -> request -> getPost('nama_supplier');
					$alamat_supplier = $this -> request -> getPost('alamat_supplier');
					$nomor_handphone_supplier = $this -> request -> getPost('nomor_handphone_supplier');

						$data = $Schema -> create_data('supplier', array(
							'id_produk' => $produk,
							'nama_supplier' => $nama_supplier,
							'alamat_supplier' => $alamat_supplier,
							'nomor_handphone_supplier' => '+62 ' . $nomor_handphone_supplier,
							'SR_CreatedBy' => session() -> get('id')
						));

				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/Home/view_supplier/?');
					
				}

			}

		}

		public function update_supplier() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$id_supplier = $this -> request -> getPost('id');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

					$produk = $this -> request -> getPost('produk');
					$nama_supplier = $this -> request -> getPost('nama_supplier');
					$alamat_supplier = $this -> request -> getPost('alamat_supplier');
					$nomor_handphone_supplier = $this -> request -> getPost('nomor_handphone_supplier');

						$data = $Schema -> update_data('supplier', array(
							'id_produk' => $produk,
							'nama_supplier' => $nama_supplier,
							'alamat_supplier' => $alamat_supplier,
							'nomor_handphone_supplier' => '+62 ' . $nomor_handphone_supplier,
							'SR_UpdatedAt' => $date -> format('Y-m-d H:i:s'),
							'SR_UpdatedBy' => session() -> get('id')
						), array('id_supplier' => $id_supplier));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di perbaharui');

					return redirect() -> to('/Home/view_supplier/?');
					
				}

			}

		}

		public function delete_supplier($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('supplier', array('id_supplier' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/Home/view_supplier/?');

				}

			}

		}
	
}