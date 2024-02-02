<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembelianProduk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pembelian' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'_supplier' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'total_item' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'total_harga' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'diskon_produk' => [
				'type' => 'INT',
				'constraint' => 3,
				'default' => '0'
			],
			'pembayaran_produk' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'P_PRODUK_createdAt DEFAULT DATETIME current_timestamp()',
			'P_PRODUK_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'P_PRODUK_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'P_PRODUK_updateBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_pembelian', true);
		$this->forge->createTable('pembelian_produk', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pembelian_produk');
	}
}