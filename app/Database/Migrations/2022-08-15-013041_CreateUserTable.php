<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'driver_licence' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'is_admin' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
            'active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'activation_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
                'unique' => true,
            ],
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
                'unique' => true,
            ],
            'reset_expiry_in' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
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

        $this->forge->addPrimaryKey('id')->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
