<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTournamentSchema extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'tag' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'contact_channel' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('teams', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'team_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 80],
            'email' => ['type' => 'VARCHAR', 'constraint' => 190],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'team_manager', 'coach', 'amateur_athlete', 'pro_athlete']],
            'status' => ['type' => 'ENUM', 'constraint' => ['active', 'suspended'], 'default' => 'active'],
            'last_login_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('users', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'team_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'display_name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'bio' => ['type' => 'TEXT', 'null' => true],
            'birth_date' => ['type' => 'DATE', 'null' => true],
            'contact_channel' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'athlete_level' => ['type' => 'ENUM', 'constraint' => ['general', 'professional'], 'null' => true],
            'current_role' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('member_profiles', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'team_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'role' => ['type' => 'VARCHAR', 'constraint' => 80],
            'joined_at' => ['type' => 'DATE', 'null' => true],
            'left_at' => ['type' => 'DATE', 'null' => true],
            'note' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('team_histories', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 190],
            'game_name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'competition_type' => ['type' => 'ENUM', 'constraint' => ['solo', 'team'], 'default' => 'team'],
            'division' => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'application_criteria' => ['type' => 'TEXT', 'null' => true],
            'rules' => ['type' => 'TEXT', 'null' => true],
            'format' => ['type' => 'TEXT', 'null' => true],
            'venue' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'registration_open_at' => ['type' => 'DATETIME', 'null' => true],
            'registration_close_at' => ['type' => 'DATETIME', 'null' => true],
            'start_at' => ['type' => 'DATETIME', 'null' => true],
            'end_at' => ['type' => 'DATETIME', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'open', 'closed', 'running', 'finished'], 'default' => 'draft'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tournaments', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'tournament_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'team_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'registered_by' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected', 'withdrawn'], 'default' => 'pending'],
            'note' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tournament_id', 'tournaments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('registered_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('registrations', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true],
            'tournament_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true],
            'round_name' => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'match_no' => ['type' => 'VARCHAR', 'constraint' => 40, 'null' => true],
            'team_a_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'team_b_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'scheduled_at' => ['type' => 'DATETIME', 'null' => true],
            'venue' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'score_a' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'score_b' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'winner_team_id' => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['scheduled', 'live', 'finished', 'cancelled'], 'default' => 'scheduled'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tournament_id', 'tournaments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_a_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('team_b_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('winner_team_id', 'teams', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('match_schedules', true);
    }

    public function down()
    {
        foreach (['match_schedules', 'registrations', 'tournaments', 'team_histories', 'member_profiles', 'users', 'teams'] as $table) {
            $this->forge->dropTable($table, true);
        }
    }
}
