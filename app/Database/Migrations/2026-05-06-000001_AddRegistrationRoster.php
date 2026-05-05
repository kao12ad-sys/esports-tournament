<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRegistrationRoster extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('min_players', 'tournaments')) {
            $this->forge->addColumn('tournaments', [
                'min_players' => [
                    'type' => 'INT',
                    'constraint' => 3,
                    'default' => 1,
                    'after' => 'division',
                ],
                'max_players' => [
                    'type' => 'INT',
                    'constraint' => 3,
                    'default' => 5,
                    'after' => 'min_players',
                ],
            ]);
        }

        if (! $this->db->tableExists('registration_players')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
                'registration_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
                'user_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addUniqueKey(['registration_id', 'user_id']);
            $this->forge->addForeignKey('registration_id', 'registrations', 'id', 'CASCADE', 'CASCADE');
            $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
            $this->forge->createTable('registration_players', true);
        }
    }

    public function down()
    {
        $this->forge->dropTable('registration_players', true);

        if ($this->db->fieldExists('min_players', 'tournaments')) {
            $this->forge->dropColumn('tournaments', ['min_players', 'max_players']);
        }
    }
}
