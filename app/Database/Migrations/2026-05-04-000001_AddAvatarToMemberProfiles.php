<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAvatarToMemberProfiles extends Migration
{
    public function up()
    {
        $fields = [
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'contact_channel',
            ],
        ];

        if (! $this->db->fieldExists('avatar', 'member_profiles')) {
            $this->forge->addColumn('member_profiles', $fields);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('avatar', 'member_profiles')) {
            $this->forge->dropColumn('member_profiles', 'avatar');
        }
    }
}
