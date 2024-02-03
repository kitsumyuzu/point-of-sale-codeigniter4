<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;
use DateTime;
use DateTimeZone;

class User extends BaseController {

	// [ Index ] ==================================================================================================== //

		public function index() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (session() -> get('id') > 0) {

				$Schema = new Schema();

					$on = 'user._level = level.id_level';

					$setting['settings'] = $Schema -> getWhere('user', array('id_user' => session() -> get('id')));
					$_fetch['data_user'] = $Schema -> visual_table_join2('user', 'level', $on);

				echo view('layout/_header');
				echo view('layout/_menu', $setting);
				echo view('pages/more/user', $_fetch);
				echo view('layout/_footer');
				
			}
			
		}

	// [ CRUD User ] ==================================================================================================== //

		public function create_user() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$profile = $this -> request -> getFile('profile');
					$username = $this -> request -> getPost('username');
					$email = $this -> request -> getPost('email');
					$password = $this -> request -> getPost('password');

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

						$data = $Schema -> create_data('user', array(
							'_profile' => $images,
							'username' => $username,
							'email' => $email,
							'password' => md5($password),
							'_level' => '2',
							'USER_createdBy' => session() -> get('id')
						));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/User/?');

				}

			}

		}

		public function update_user() {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$id = $this -> request -> getPost('id');
					$userProfile = $this -> request -> getPost('userprofile');
					$profile = $this -> request -> getFile('profile');
					$username = $this -> request -> getPost('username');
					$email = $this -> request -> getPost('email');
					$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

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

						$data = $Schema -> update_data('user', array(
							'_profile' => $images,
							'username' => $username,
							'email' => $email,
							'USER_updatedAt' => $date -> format('Y-m-d H:i:s'),
							'USER_updatedBy' => session() -> get('id')
						), array('id_user' => $id));
					
				if ($data) {
					
					session() -> setFlashdata('message', 'baru berhasil di tambahkan');

					return redirect() -> to('/User/?');

				}

			}

		}

		public function delete_user($id) {

			if (session() -> get('id') == NULL || session() -> get('id') < 0) {

				return redirect() -> to('/home/');

			} else if (in_array(session() -> get('level'), [1]) && session() -> get('id') > 0) {

				$Schema = new Schema();

					$data = $Schema -> delete_data('user', array('id_user' => $id));

				if ($data) {
					
					session() -> setFlashdata('message', 'berhasil di hapus');

					return redirect() -> to('/User/?');

				}

			}

		}

}