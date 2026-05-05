<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSocialLinksToMemberProfiles extends Migration
{
    public function up()
    {
        $fields = [
            'social_facebook' => [
                'type'       => 'VARCHAR',
                'constraint' => '191',
                'null'       => true,
                'after'      => 'contact_channel',
            ],
            'social_line' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'social_facebook',
            ],
            'social_instagram' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'social_line',
            ],
            'social_x' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'social_instagram',
            ],
        ];
        $this->forge->addColumn('member_profiles', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('member_profiles', ['social_facebook', 'social_line', 'social_instagram', 'social_x']);
    }
}
