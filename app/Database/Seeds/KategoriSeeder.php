<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kategori' => 'elektronik', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'pakaian_aksesoris', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'makanan', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'minuman', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'kesehatan', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'kecantikan', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'peralatan rumah tangga', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'otomotif', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'peralatan olahraga & rekreasi', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'peralatan sekolah & kantor', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'mainan', 'KATEGORI_createdBy' => '1'],
            ['kategori' => 'furniture', 'KATEGORI_createdBy' => '1'],
        ];

        $this -> db -> table('kategori') -> insertBatch($data);
    }
}