<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('teams')->ignore(true)->insertBatch([
            [
                'id' => 1,
                'name' => 'National Alpha',
                'tag' => 'ALP',
                'description' => 'ทีมตัวอย่างสำหรับทดสอบระบบ',
                'contact_channel' => 'alpha@example.test',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $users = [
            ['id' => 1, 'team_id' => null, 'username' => 'admin', 'email' => 'admin@example.test', 'role' => 'admin'],
            ['id' => 5, 'team_id' => null, 'username' => 'staff', 'email' => 'staff@example.test', 'role' => 'staff'],
            ['id' => 2, 'team_id' => 1, 'username' => 'manager', 'email' => 'manager@example.test', 'role' => 'team_manager'],
            ['id' => 3, 'team_id' => 1, 'username' => 'coach', 'email' => 'coach@example.test', 'role' => 'coach'],
            ['id' => 4, 'team_id' => 1, 'username' => 'player', 'email' => 'player@example.test', 'role' => 'amateur_athlete'],
        ];

        foreach ($users as $user) {
            $user['password_hash'] = password_hash('Password@123', PASSWORD_DEFAULT);
            $user['status'] = 'active';
            $user['created_at'] = $now;
            $user['updated_at'] = $now;
            $this->db->table('users')->ignore(true)->insert($user);
        }

        $this->db->table('member_profiles')->ignore(true)->insertBatch([
            ['user_id' => 2, 'team_id' => 1, 'display_name' => 'Team Manager', 'bio' => null, 'birth_date' => null, 'contact_channel' => null, 'athlete_level' => null, 'current_role' => 'ผู้จัดการทีม', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3, 'team_id' => 1, 'display_name' => 'Coach One', 'bio' => null, 'birth_date' => null, 'contact_channel' => null, 'athlete_level' => null, 'current_role' => 'ผู้ฝึกสอน', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4, 'team_id' => 1, 'display_name' => 'Player One', 'bio' => null, 'birth_date' => null, 'contact_channel' => null, 'athlete_level' => 'general', 'current_role' => 'นักกีฬาทั่วไป', 'status' => 'active', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->db->table('tournaments')->ignore(true)->insert([
            'id' => 1,
            'name' => 'Thailand Esports National Championship',
            'game_name' => 'Valorant',
            'competition_type' => 'team',
            'division' => 'Open',
            'application_criteria' => 'ผู้สมัครต้องมีทีมที่ได้รับการยืนยัน และสมาชิกครบตามกติกา',
            'rules' => 'ใช้กติกาการแข่งขันมาตรฐานระดับประเทศ มีการตรวจสอบตัวตนก่อนแข่ง',
            'format' => 'Group Stage และ Single Elimination Playoffs',
            'venue' => 'Bangkok Esports Arena',
            'registration_open_at' => $now,
            'registration_close_at' => date('Y-m-d H:i:s', strtotime('+30 days')),
            'start_at' => date('Y-m-d H:i:s', strtotime('+45 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime('+47 days')),
            'status' => 'open',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
