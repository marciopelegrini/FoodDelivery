<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerTableMesures extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'actif' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],

        ]);

        $this->forge->addPrimaryKey('id')->addUniqueKey('nom');
        $this->forge->createTable('mesures');
    }

    public function down()
    {
        $this->forge->dropTable('mesures');
    }
}
