<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Member extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_member' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'kode_member' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true
			],
			'nama_member' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true
			],
			'alamat_member' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'nomor_handphone_member' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'MEMBER_createdAt DATETIME DEFAULT current_timestamp',
			'MEMBER_createdBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			],
			'MEMBER_updatedAt' => [
				'type' => 'DATETIME',
				'null' => true
			],
			'MEMBER_updatedBy' => [
				'type' => 'INT',
				'constraint' => 10,
				'null' => true
			]
		]);

		$this->forge->addKey('id_member', true);
		$this->forge->createTable('member', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('member');
	}
}
