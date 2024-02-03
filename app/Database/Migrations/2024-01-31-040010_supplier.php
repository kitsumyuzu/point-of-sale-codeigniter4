<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
	public function up()
	{
		$this->forge->dropTable('supplier', true);
		
		$this->forge->addField([
			'id_supplier' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'produk_supplier' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'nama_supplier' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true
			],
			'alamat_supplier' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'nomor_handphone_supplier' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'SUPPLIER_createdAt DATETIME DEFAULT current_timestamp',
			'SUPPLIER_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'SUPPLIER_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'SUPPLIER_updatedBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_supplier', true);
		$this->forge->createTable('supplier', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('supplier');
	}
}
