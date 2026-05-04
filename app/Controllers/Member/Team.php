<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\TeamHistoryModel;
use App\Models\TeamModel;
use App\Models\UserModel;

class Team extends BaseController
{
    public function index()
    {
        $teamId = session('team_id');
        $teamModel = new TeamModel();
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'POST') {
            if (session('role') !== 'team_manager') {
                return redirect()->back()->with('error', 'เฉพาะผู้จัดการทีมเท่านั้นที่แก้ไขข้อมูลทีมได้');
            }

            $rules = [
                'name' => 'required|max_length[150]',
                'tag' => 'permit_empty|max_length[30]',
                'description' => 'permit_empty',
                'contact_channel' => 'permit_empty|max_length[190]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
            }

            $data = $this->request->getPost(['name', 'tag', 'description', 'contact_channel']);
            $data['status'] = 'active';

            if ($teamId) {
                $teamModel->update($teamId, $data);
            } else {
                $teamId = $teamModel->insert($data);
                $userModel->update(session('user_id'), ['team_id' => $teamId]);
                session()->set('team_id', $teamId);

                (new TeamHistoryModel())->insert([
                    'user_id' => session('user_id'),
                    'team_id' => $teamId,
                    'role' => 'ผู้จัดการทีม',
                    'joined_at' => date('Y-m-d'),
                    'note' => 'สร้างทีมโดยผู้จัดการทีม',
                ]);
            }

            return redirect()->back()->with('success', 'บันทึกข้อมูลทีมแล้ว');
        }

        $teamId = session('team_id');

        return view('member/team', [
            'title' => 'ทีมของฉัน',
            'team' => $teamId ? $teamModel->find($teamId) : null,
            'members' => $teamId ? $userModel->where('team_id', $teamId)->where('role !=', 'admin')->findAll() : [],
            'histories' => $teamId ? (new TeamHistoryModel())
                ->select('team_histories.*, teams.name AS team_name, users.username')
                ->join('teams', 'teams.id = team_histories.team_id')
                ->join('users', 'users.id = team_histories.user_id')
                ->where('team_histories.team_id', $teamId)
                ->orderBy('team_histories.id', 'DESC')
                ->findAll(30) : [],
        ]);
    }
}
