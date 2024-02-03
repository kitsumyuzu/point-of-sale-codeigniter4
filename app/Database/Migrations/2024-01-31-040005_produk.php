<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_produk' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'kategori_produk' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'kode_produk' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true
			],
			'nama_produk' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'merk_produk' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'harga_pembelian' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'harga_penjualan' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'diskon_produk' => [
				'type' => 'INT',
				'constraint' => 3,
				'null' => true,
				'default' => '0'
			],
			'stok_produk' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true,
				'default' => 0
			],
			'PRODUK_createdAt DATETIME DEFAULT current_timestamp',
			'PRODUK_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'PRODUK_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'PRODUK_updatedBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_produk', true);
		$this->forge->createTable('produk', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('produk');
	}
}
