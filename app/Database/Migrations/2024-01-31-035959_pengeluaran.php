<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengeluaran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pengeluaran' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'tanggal_pengeluaran' => [
				'type' => 'DATE',
				'null' => true
			],
			'jenis_pengeluaran' => [
				'type' => 'TEXT',
				'null' => true
			],
			'nominal_pengeluaran' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'PENGELUARAN_createdAt DATETIME DEFAULT current_timestamp',
			'PENGELUARAN_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'PENGELUARAN_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'PENGELUARAN_updatedBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_pengeluaran', true);
		$this->forge->createTable('pengeluaran', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pengeluaran');
	}
}
