<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatTable extends Migration
{
    public function up()
    {
        $data = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
        ];
        $this->forge->addField($data);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('subjects', true);
        $this->forge->reset();

        $this->forge->addField($data);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('supervisory_authorities');
        $this->forge->reset();

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'subject_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'authority_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'start_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'finish_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('subject_id', 'subjects', 'id');
        $this->forge->addForeignKey('authority_id', 'supervisory_authorities', 'id');
        $this->forge->createTable('checks');
    }

    public function down()
    {
        $this->forge->dropTable('checks');
        $this->forge->dropTable('supervisory_authorities');
        $this->forge->dropTable('subjects');
    }
}
