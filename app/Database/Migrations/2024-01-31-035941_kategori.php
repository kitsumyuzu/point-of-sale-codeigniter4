<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kategori' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'kategori' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'KATEGORI_createdAt DATETIME DEFAULT current_timestamp',
			'KATEGORI_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'KATEGORI_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'KATEGORI_updatedBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_kategori', true);
		$this->forge->createTable('kategori', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kategori');
	}
}
