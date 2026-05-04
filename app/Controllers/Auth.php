<?php

namespace App\Controllers;

use App\Models\MemberProfileModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function adminLogin()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'กรุณากรอกอีเมลและรหัสผ่านให้ถูกต้อง');
            }

            $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();
            if (! $user || $user['role'] !== 'admin' || $user['status'] !== 'active' || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
                return redirect()->back()->withInput()->with('error', 'บัญชีผู้ดูแลระบบหรือรหัสผ่านไม่ถูกต้อง');
            }

            $this->startUserSession($user);

            return redirect()->to('/adminz');
        }

        return view('auth/admin_login', ['title' => 'Admin Login']);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'login_role' => 'required|in_list[staff,member,manager,coach]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'กรุณาเลือกประเภทผู้ใช้งาน และกรอกอีเมล/รหัสผ่านให้ถูกต้อง');
            }

            $loginRole = (string) $this->request->getPost('login_role');
            $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();
            if (! $user || $user['status'] !== 'active' || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
                return redirect()->back()->withInput()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง');
            }

            if (! $this->roleMatchesLoginType($user['role'], $loginRole)) {
                return redirect()->back()->withInput()->with('error', 'บัญชีนี้ไม่ตรงกับประเภทผู้ใช้งานที่เลือก');
            }

            $this->startUserSession($user);

            return redirect()->to($user['role'] === 'staff' ? '/adminz' : '/member');
        }

        return view('auth/login', ['title' => 'เข้าสู่ระบบ']);
    }

    public function register()
    {
        $botChallenge = $this->getBotChallenge();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[80]|is_unique[users.username]',
                'email' => 'required|valid_email|max_length[190]|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'required|matches[password]',
                'bot_answer' => 'required|integer',
            ];

            if (! $this->validate($rules)) {
                $this->resetBotChallenge();
                return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
            }

            if ((int) $this->request->getPost('bot_answer') !== (int) session('register_bot_answer')) {
                $this->resetBotChallenge();
                return redirect()->back()->withInput()->with('error', 'กรุณายืนยันตัวตนด้วย bot ให้ถูกต้อง');
            }

            $role = 'amateur_athlete';
            $userId = (new UserModel())->insert([
                'team_id' => null,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $role,
                'status' => 'active',
            ]);

            if (! $userId) {
                $this->resetBotChallenge();
                return redirect()->back()->withInput()->with('error', 'ไม่สามารถสร้างบัญชีได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            }

            (new MemberProfileModel())->insert([
                'user_id' => $userId,
                'team_id' => null,
                'display_name' => $this->request->getPost('username'),
                'athlete_level' => 'general',
                'current_role' => $this->roleLabel($role),
                'status' => 'active',
            ]);

            $this->resetBotChallenge();

            return redirect()->to('/login')->with('success', 'สร้างบัญชีนักกีฬาเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ');
        }

        return view('auth/register', [
            'title' => 'สมัครสมาชิก',
            'botQuestion' => $botChallenge['question'],
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'ออกจากระบบเรียบร้อย');
    }

    private function startUserSession(array $user): void
    {
        session()->regenerate(true);
        session()->set([
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'team_id' => $user['team_id'],
            'username' => $user['username'],
            'role' => $user['role'],
        ]);

        (new UserModel())->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);
    }

    private function memberRoleOptions(): array
    {
        return [
            'amateur_athlete' => 'นักกีฬาทั่วไป',
            'pro_athlete' => 'นักกีฬาอาชีพ',
        ];
    }

    private function roleLabel(string $role): string
    {
        return $this->memberRoleOptions()[$role] ?? $role;
    }

    private function roleMatchesLoginType(string $role, string $loginRole): bool
    {
        return match ($loginRole) {
            'staff' => $role === 'staff',
            'manager' => $role === 'team_manager',
            'coach' => $role === 'coach',
            'member' => in_array($role, ['amateur_athlete', 'pro_athlete'], true),
            default => false,
        };
    }

    private function getBotChallenge(): array
    {
        if (! session()->has('register_bot_answer') || ! session()->has('register_bot_question')) {
            $left = random_int(2, 9);
            $right = random_int(1, 9);
            session()->set([
                'register_bot_question' => $left . ' + ' . $right . ' = ?',
                'register_bot_answer' => $left + $right,
            ]);
        }

        return [
            'question' => session('register_bot_question'),
            'answer' => session('register_bot_answer'),
        ];
    }

    private function resetBotChallenge(): void
    {
        session()->remove(['register_bot_question', 'register_bot_answer']);
    }
}
