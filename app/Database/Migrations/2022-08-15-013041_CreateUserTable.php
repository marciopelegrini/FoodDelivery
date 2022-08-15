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
                'constraint' => '255',
            ],
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            'modified_at' => [
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

        $this->forge->addKey('blog_id', true);
        $this->forge->createTable('blog');
    }

    public function down()
    {
        //
    }
}
