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
        $users = (new UserModel())
            ->select('users.*, teams.name AS team_name, member_profiles.display_name, member_profiles.contact_channel, member_profiles.birth_date')
            ->join('teams', 'teams.id = users.team_id', 'left')
            ->join('member_profiles', 'member_profiles.user_id = users.id', 'left')
            ->where('users.role !=', 'admin')
            ->orderBy('users.id', 'DESC')
            ->findAll();

        return view('admin/people/index', [
            'title' => 'จัดการผู้จัดการทีม ผู้ฝึกสอน และนักกีฬา',
            'items' => $users,
            'teams' => (new TeamModel())->findAll(),
        ]);
    }

    public function create()
    {
        $password = (string) $this->request->getPost('password');
        $userId = (new UserModel())->insert([
            'team_id' => $this->request->getPost('team_id') ?: null,
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'status' => 'active',
        ]);

        if ($userId) {
            (new MemberProfileModel())->insert([
                'user_id' => $userId,
                'team_id' => $this->request->getPost('team_id') ?: null,
                'display_name' => $this->request->getPost('display_name') ?: $this->request->getPost('username'),
                'birth_date' => $this->request->getPost('birth_date') ?: null,
                'contact_channel' => $this->request->getPost('contact_channel'),
                'current_role' => $this->request->getPost('role'),
                'athlete_level' => $this->request->getPost('role') === 'pro_athlete' ? 'professional' : 'general',
            ]);
        }

        return redirect()->back()->with('success', 'เพิ่มสมาชิกแล้ว');
    }

    public function delete($id)
    {
        (new UserModel())->delete($id);
        return redirect()->back()->with('success', 'ลบสมาชิกแล้ว');
    }
}
