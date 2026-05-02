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

        if ($this->request->getMethod() === 'POST' && session('role') === 'team_manager') {
            $teamModel->update($teamId, $this->request->getPost(['name', 'tag', 'description', 'contact_channel']));
            return redirect()->back()->with('success', 'อัปเดตข้อมูลทีมแล้ว');
        }

        return view('member/team', [
            'title' => 'ทีมของฉัน',
            'team' => $teamId ? $teamModel->find($teamId) : null,
            'members' => $teamId ? (new UserModel())->where('team_id', $teamId)->where('role !=', 'admin')->findAll() : [],
            'histories' => (new TeamHistoryModel())
                ->select('team_histories.*, teams.name AS team_name, users.username')
                ->join('teams', 'teams.id = team_histories.team_id')
                ->join('users', 'users.id = team_histories.user_id')
                ->orderBy('team_histories.id', 'DESC')
                ->findAll(30),
        ]);
    }
}
