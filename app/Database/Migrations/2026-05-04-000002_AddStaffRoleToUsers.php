<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaffRoleToUsers extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE users MODIFY role ENUM('admin','staff','team_manager','coach','amateur_athlete','pro_athlete') NOT NULL");
    }

    public function down()
    {
        $this->db->table('users')->where('role', 'staff')->update(['role' => 'admin']);
        $this->db->query("ALTER TABLE users MODIFY role ENUM('admin','team_manager','coach','amateur_athlete','pro_athlete') NOT NULL");
    }
}
