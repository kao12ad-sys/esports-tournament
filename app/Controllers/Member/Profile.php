<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\MemberProfileModel;

class Profile extends BaseController
{
    public function index()
    {
        $model = new MemberProfileModel();
        $profile = $model->where('user_id', session('user_id'))->first();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost(['display_name', 'bio', 'birth_date', 'contact_channel']);
            $data['team_id'] = session('team_id');

            if ($profile) {
                $model->update($profile['id'], $data);
            } else {
                $data['user_id'] = session('user_id');
                $model->insert($data);
            }

            return redirect()->back()->with('success', 'บันทึกข้อมูลส่วนตัวแล้ว');
        }

        return view('member/profile', ['title' => 'ข้อมูลส่วนตัว', 'profile' => $profile]);
    }
}
