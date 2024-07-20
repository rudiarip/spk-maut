<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubKriteria extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id_sub'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_kriteria'      => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'nama_sub'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'nilai_sub'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'null'           => true,
            ],
            'created_at'      => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'created_by'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'updated_at'      => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'updated_by'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id_sub', TRUE);

        // Membuat tabel news
        $this->forge->createTable('tbl_sub_kriteria', TRUE);
    }

    public function down()
    {
        // menghapus tabel news
        $this->forge->dropTable('tbl_sub_kriteria');
    }
}
