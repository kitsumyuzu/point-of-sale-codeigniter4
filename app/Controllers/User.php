<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class User extends BaseController {

	// [ Index ] ==================================================================================================== //

		public function index() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'user._level = level.id_level';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['userdata'] = $Schema -> visual_table_join2('user', 'level', $on);

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/user_data', $_fetch);
				echo view('layout/_footer');
				
			}
			
		}

	// [ View ] ==================================================================================================== //

		public function view_insertUser() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['level'] = $Schema -> visual_table('level');

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('forms/user_insert', $_fetch);
				echo view('layout/_footer');
				
			}

		}

		public function view_updateUser($_id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'karyawan._user = user.id_user';
					$on2 = 'pelanggan._user = user.id_user';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['level'] = $Schema -> visual_table('level');
					$_fetch['karyawanData'] = $Schema -> getWhere_table_join_2('user', 'karyawan', $on, array('id_user' => $_id));
					$_fetch['pelangganData'] = $Schema -> getWhere_table_join_2('user', 'pelanggan', $on2, array('id_user' => $_id));

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('forms/user_update', $_fetch);
				echo view('layout/_footer');
				
			}

		}
    
        public function karyawan() {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'karyawan._user = user.id_user';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['karyawandata'] = $Schema -> visual_table_join2('karyawan', 'user', $on);

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/karyawan_data', $_fetch);
				echo view('layout/_footer');
				
			}

        }

        public function pelanggan() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'pelanggan._user = user.id_user';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['pelanggandata'] = $Schema -> visual_table_join2('pelanggan', 'user', $on);

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/pelanggan_data', $_fetch);
				echo view('layout/_footer');
				
			}

        }

	// [ System Function ] ==================================================================================================== //

		public function insert_userData() {

			if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$username = $this -> request -> getPost('username');
					$email = $this -> request -> getPost('email');
					$password = $this -> request -> getPost('password');
					$level = $this -> request -> getPost('level');
					
					$nama_depan = $this -> request -> getPost('nama_depan');
					$nama_belakang = $this -> request -> getPost('nama_belakang');
					$jenis_kelamin = $this -> request -> getPost('jenis_kelamin');
					$tanggal_lahir = $this -> request -> getPost('tanggal_lahir');
					$tempat_lahir = $this -> request -> getPost('tempat_lahir');
					$nomor_handphone = $this -> request -> getPost('nomor_handphone');
					$alamat = $this -> request -> getPost('alamat');

					$profile = $this -> request -> getFile('profile');

				if ($profile && $profile -> isValid() && ! $profile -> hasMoved()) {
                    
                    if ($profile == 'default-profile.png' || NULL) {

                        $images = $profile -> getRandomName();
                        $profile -> move('assets/images/', $images);

                    } else {

                        $images = $profile -> getRandomName();
                        $profile -> move('assets/images/', $images);

                    }

                } else {

                    $images = 'default-profile.png';

                }

				switch ($level) {

					case 1:

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'password' => md5($password),
								'_level' => '1'
							);
	
						$Schema -> insert_data('user', $_data);
		
						$where = $Schema -> getWhere2('user', array('username' => $username));
						$id = $where['id_user'];
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'no_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_user' => $id,
								'_createdAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_createdBy' => session() -> get('id')
							);
		
						$Schema -> insert_data('karyawan', $_data2);
		
						return redirect() -> to('/User/');

					break;

					case 2:

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'password' => md5($password),
								'_level' => '2'
							);
	
						$Schema -> insert_data('user', $_data);
		
						$where = $Schema -> getWhere2('user', array('username' => $username));
						$id = $where['id_user'];
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'no_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_user' => $id,
								'_createdAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_createdBy' => session() -> get('id')
							);
		
						$Schema -> insert_data('pelanggan', $_data2);
		
						return redirect() -> to('/User/');

					break;

					default;

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'password' => md5($password),
								'_level' => '2'
							);
	
						$Schema -> insert_data('user', $_data);
		
						$where = $Schema -> getWhere2('user', array('username' => $username));
						$id = $where['id_user'];
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'nomor_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_user' => $id,
								'_createdAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_createdBy' => session() -> get('id')
							);
		
						$Schema -> insert_data('pelanggan', $_data2);
		
						return redirect() -> to('/User/');

					break;
				}

			}

		}
	
		public function update_userData() {

			if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$username = $this -> request -> getPost('username');
					$email = $this -> request -> getPost('email');
					$level = $this -> request -> getPost('level');

					$userId = $this -> request -> getPost('userId');
					$userDId = $this -> request -> getPost('userDiD');
					
					$nama_depan = $this -> request -> getPost('nama_depan');
					$nama_belakang = $this -> request -> getPost('nama_belakang');
					$jenis_kelamin = $this -> request -> getPost('jenis_kelamin');
					$tanggal_lahir = $this -> request -> getPost('tanggal_lahir');
					$tempat_lahir = $this -> request -> getPost('tempat_lahir');
					$nomor_handphone = $this -> request -> getPost('nomor_handphone');
					$alamat = $this -> request -> getPost('alamat');

					$profile = $this -> request -> getFile('profile');
					$userProfile = $this -> request -> getPost('userProfile');

					if ($profile && $profile -> isValid() && ! $profile -> hasMoved()) {
                    
						if ($profile == 'default-profile.png' || NULL) {
	
							$images = $profile -> getRandomName();
							$profile -> move('assets/images/', $images);
	
						} else {
	
							if (file_exists('assets/images/'. $profile)) {
	
								unlink('assets/images/'.$userProfile);
	
							} else {
	
								$images = $profile -> getRandomName();
								$profile -> move('assets/images/', $images);
	
							}
	
						}
	
					} else {
	
						if ($userProfile == 'default-profile.png' || NULL) {
							
							$images = 'default-profile.png';
	
						} else {
	
							$images = $userProfile;
	
						}
	
					}

				switch ($level) {

					case 1:

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'_level' => '1'
							);
	
						$Schema -> edit_data('user', $_data, array('id_user' => $userId));
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'no_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_updatedAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_updatedBy' => session() -> get('id')
							);
		
						$Schema -> edit_data('karyawan', $_data2, array('_user' => $userDId));
		
						return redirect() -> to('/User/');

					break;

					case 2:

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'_level' => '2'
							);
	
						$Schema -> edit_data('user', $_data, array('id_user' => $userId));
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'no_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_updatedAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_updatedBy' => session() -> get('id')
							);
		
						$Schema -> edit_data('pelanggan', $_data2, array('_user' => $userDId));
		
						return redirect() -> to('/User/');

					break;

					default;

							$_data = array(
								'profile' => $images,
								'username' => $username,
								'email' => $email,
								'_level' => '2'
							);
	
						$Schema -> insert_data('user', $_data);
		
						$where = $Schema -> getWhere2('user', array('username' => $username));
						$id = $where['id_user'];
		
							$_data2 = array(
								'nama_depan' => $nama_depan,
								'nama_belakang' => $nama_belakang,
								'jenis_kelamin' => $jenis_kelamin,
								'tanggal_lahir' => $tanggal_lahir,
								'tempat_lahir' => $tempat_lahir,
								'nomor_handphone' => '+62 ' . $nomor_handphone,
								'alamat' => $alamat,
								'_user' => $id,
								'_createdAt' => date('Y-m-d H:i:s', strtotime('now')),
								'_createdBy' => session() -> get('id')
							);
		
						$Schema -> insert_data('pelanggan', $_data2);
		
						return redirect() -> to('/User/');

					break;
				}

			}

		}

		public function delete_karyawanData($_id) {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

                return redirect() -> to('/home/');

            } else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

                $Schema = new Schema();

                    $Schema -> delete_data('user', array('id_user' => $_id));
                    $Schema -> delete_data('karyawan', array('_user' => $_id));

                return redirect() -> to('/user/');

            }

        }

		public function delete_pelangganData($_id) {

            if (session() -> get('id') == NULL || session() -> get('id') < 0) {

                return redirect() -> to('/home/');

            } else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

                $Schema = new Schema();

                    $Schema -> delete_data('user', array('id_user' => $_id));
                    $Schema -> delete_data('pelanggan', array('_user' => $_id));

                return redirect() -> to('/user/');

            }

        }

}