<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contenidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'palabras_clave' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'area_conocimiento' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],
            'tipo_contenido' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],
            'imagen_portada' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
            'contenido' => [
                'type' => 'LONGTEXT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contenidos');
    }

    public function down()
    {
        $this->forge->dropTable('publicaciones');
    }
}
