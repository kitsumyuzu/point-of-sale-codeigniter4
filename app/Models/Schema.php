<?php namespace App\Models;

use CodeIgniter\Model;

class Schema extends Model {

	// Notes: If you change the files name, make sure to also change class name.

	/* ---------------------------------------------------------------------- */

		public function visual_table($table) {

			return $this -> db -> table($table) -> get() -> getResultArray();

		}

		public function visual_table_join2($table1, $table2, $on) {

			return $this -> db -> table($table1) -> join($table2, $on, 'left') -> get() -> getResultArray();
		
		}

		public function visual_table_join3($table1, $table2, $table3, $on1, $on2) {

			return $this -> db -> table($table1) -> join($table2, $on1, 'left') -> join($table3, $on2, 'left') -> get() -> getResultArray();
			
		}

		public function visual_table_join4($table1, $table2, $table3, $table4, $on1, $on2, $on3) {

			return $this -> db -> table($table1) -> join($table2, $on1, 'left') -> join($table3, $on2, 'left') -> join($table4, $on3, 'left') -> get() -> getResultArray();
			
		}

	/* ---------------------------------------------------------------------- */

		public function create_data($table, $data) {

			return $this -> db -> table($table) -> insert($data);
		
		}
		
		public function update_data($table, $data, $where) {
		
			return $this -> db -> table($table) -> update($data, $where);

		}
		
		public function delete_data($table, $where) {
		
			return $this -> db -> table($table) -> delete($where);
		
		}

	/* ---------------------------------------------------------------------- */

		public function getWhere($table, $where) {

			return $this -> db -> table($table) -> getWhere($where) -> getRow();
		
		}
		
		public function getWhere2($table, $where) {
		
			return $this -> db -> table($table) -> getWhere($where) -> getRowArray();
		
		}

	/* ---------------------------------------------------------------------- */

		public function getWhere_table_join_2($table1, $table2, $on, $where) {

			return $this -> db -> table($table1) -> join($table2, $on, 'left') -> getWhere($where) -> getRow();
			
		}

		public function getWhere_table_join_3($table1, $table2, $table3, $on, $on2, $where) {

			return $this -> db -> table($table1) -> join($table2, $on, 'left') -> join($table3, $on2, 'left') -> getWhere($where) -> getRow();
			
		}

	/* ---------------------------------------------------------------------- */

		public function isCodeExists($code) {

			$query = $this -> db -> table('produk') -> getWhere(['kode_produk' => $code]);
    		$result = $query -> getResult();
    		return count($result) > 0;

		}

		private function generateRandomString($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
		
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		
			return $randomString;
		}

		public function generateUniqueCode() {
			do {
		
				// Membuat karakter acak (misalnya, 4 karakter)
				$randomChars = $this -> generateRandomString(8);
		
				// Menggabungkan karakter acak, dan bagian unik dari uniqid
				$generatedCode = $randomChars . substr(uniqid(), 8, 4);

			} while ($this -> isCodeExists($generatedCode));
		
			return $generatedCode;
		}

		public function isCodeExists2($code) {

			$query = $this -> db -> table('member') -> getWhere(['kode_member' => $code]);
    		$result = $query -> getResult();
    		return count($result) > 0;

		}

		private function generateRandomString2($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
		
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		
			return $randomString;
		}

		public function generateUniqueCode2() {
			do {
		
				// Membuat karakter acak (misalnya, 4 karakter)
				$randomChars = $this -> generateRandomString(8);
		
				// Menggabungkan karakter acak, dan bagian unik dari uniqid
				$generatedCode = $randomChars . substr(uniqid(), 8, 4);

			} while ($this -> isCodeExists($generatedCode));
		
			return $generatedCode;
		}

}