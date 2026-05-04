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
            $rules = [
                'display_name' => 'permit_empty|max_length[120]',
                'birth_date' => 'permit_empty|valid_date[Y-m-d]',
                'contact_channel' => 'permit_empty|max_length[190]',
                'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
            }

            $data = $this->request->getPost(['display_name', 'bio', 'birth_date', 'contact_channel']);
            $data['team_id'] = session('team_id');
            $data['birth_date'] = $data['birth_date'] ?: null;
            $data['display_name'] = $data['display_name'] ?: session('username');

            if ($this->request->getPost('delete_avatar') === '1' && $profile && ! empty($profile['avatar'])) {
                $this->deleteAvatarFile($profile['avatar']);
                $data['avatar'] = null;
            }

            $avatar = $this->request->getFile('avatar');
            if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
                if ($profile && ! empty($profile['avatar'])) {
                    $this->deleteAvatarFile($profile['avatar']);
                }

                $avatarName = $avatar->getRandomName();
                if (! is_dir(FCPATH . 'uploads/members')) {
                    mkdir(FCPATH . 'uploads/members', 0755, true);
                }
                $avatar->move(FCPATH . 'uploads/members', $avatarName);
                $data['avatar'] = 'uploads/members/' . $avatarName;
            }

            if ($profile) {
                $model->update($profile['id'], $data);
            } else {
                $data['user_id'] = session('user_id');
                $model->insert($data);
            }

            return redirect()->back()->with('success', 'บันทึกข้อมูลส่วนตัวแล้ว');
        }

        return view('member/profile', [
            'title' => 'ข้อมูลส่วนตัว',
            'profile' => $profile,
        ]);
    }

    private function deleteAvatarFile(string $avatar): void
    {
        $path = realpath(FCPATH . $avatar);
        $uploadRoot = realpath(FCPATH . 'uploads/members');

        if ($path && $uploadRoot && str_starts_with($path, $uploadRoot) && is_file($path)) {
            unlink($path);
        }
    }
}
