<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberProfileModel;
use App\Models\TeamModel;
use App\Models\UserModel;

class People extends BaseController
{
    public function index(): string
    {
        $role = $this->request->getGet('role');
        $builder = (new UserModel())
            ->select('users.*, teams.name AS team_name, member_profiles.display_name, member_profiles.contact_channel, member_profiles.birth_date')
            ->join('teams', 'teams.id = users.team_id', 'left')
            ->join('member_profiles', 'member_profiles.user_id = users.id', 'left')
            ->where('users.role !=', 'admin');

        if ($role === 'athletes') {
            $builder->whereIn('users.role', ['amateur_athlete', 'pro_athlete']);
        } elseif (in_array($role, ['staff', 'team_manager', 'coach', 'amateur_athlete', 'pro_athlete'], true)) {
            $builder->where('users.role', $role);
        }

        $titles = [
            'staff' => 'จัดการข้อมูล Staff',
            'team_manager' => 'จัดการข้อมูลผู้จัดการทีม',
            'coach' => 'จัดการข้อมูลผู้ฝึกสอน',
            'athletes' => 'จัดการข้อมูลนักกีฬา',
            'amateur_athlete' => 'จัดการข้อมูลนักกีฬาทั่วไป',
            'pro_athlete' => 'จัดการข้อมูลนักกีฬาอาชีพ',
        ];

        return view('admin/people/index', [
            'title' => $titles[$role] ?? 'จัดการผู้จัดการทีม ผู้ฝึกสอน และนักกีฬา',
            'items' => $builder->orderBy('users.id', 'DESC')->findAll(),
            'teams' => (new TeamModel())->findAll(),
            'selectedRole' => $role,
        ]);
    }

    public function create()
    {
        $role = (string) $this->request->getPost('role');
        $password = (string) $this->request->getPost('password');

        $userId = (new UserModel())->insert([
            'team_id' => $this->request->getPost('team_id') ?: null,
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'status' => 'active',
        ]);

        if ($userId) {
            (new MemberProfileModel())->insert([
                'user_id' => $userId,
                'team_id' => $this->request->getPost('team_id') ?: null,
                'display_name' => $this->request->getPost('display_name') ?: $this->request->getPost('username'),
                'birth_date' => $this->request->getPost('birth_date') ?: null,
                'contact_channel' => $this->request->getPost('contact_channel'),
                'current_role' => $this->roleLabel($role),
                'athlete_level' => $role === 'pro_athlete' ? 'professional' : ($role === 'amateur_athlete' ? 'general' : null),
            ]);
        }

        return redirect()->back()->with('success', 'เพิ่มสมาชิกแล้ว');
    }

    public function delete($id)
    {
        if (session('role') === 'staff') {
            return redirect()->back()->with('error', 'บัญชี Staff ไม่มีสิทธิ์ลบข้อมูล');
        }

        (new UserModel())->delete($id);

        return redirect()->back()->with('success', 'ลบสมาชิกแล้ว');
    }

    private function roleLabel(string $role): string
    {
        return [
            'staff' => 'Staff',
            'team_manager' => 'ผู้จัดการทีม',
            'coach' => 'ผู้ฝึกสอน',
            'amateur_athlete' => 'นักกีฬาทั่วไป',
            'pro_athlete' => 'นักกีฬาอาชีพ',
        ][$role] ?? $role;
    }
}
