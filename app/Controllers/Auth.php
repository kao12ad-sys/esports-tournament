<?php

namespace App\Controllers;

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

            session()->regenerate(true);
            session()->set([
                'isLoggedIn' => true,
                'user_id' => $user['id'],
                'team_id' => $user['team_id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ]);

            (new UserModel())->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);

            return redirect()->to('/adminz');
        }

        return view('auth/admin_login', ['title' => 'Admin Login']);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง');
            }

            $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();
            if (! $user || $user['status'] !== 'active' || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
                return redirect()->back()->withInput()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง');
            }

            session()->regenerate(true);
            session()->set([
                'isLoggedIn' => true,
                'user_id' => $user['id'],
                'team_id' => $user['team_id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ]);

            (new UserModel())->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);

            return redirect()->to($user['role'] === 'admin' ? '/adminz' : '/member');
        }

        return view('auth/login', ['title' => 'เข้าสู่ระบบ']);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'ออกจากระบบเรียบร้อย');
    }
}
