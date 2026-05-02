<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\ScheduleModel;
use App\Models\TeamModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $teamId = session('team_id');

        return view('member/dashboard', [
            'title' => 'Member Dashboard',
            'team' => $teamId ? (new TeamModel())->find($teamId) : null,
            'members' => $teamId ? (new UserModel())->where('team_id', $teamId)->findAll() : [],
            'registrations' => $teamId ? (new RegistrationModel())->where('team_id', $teamId)->countAllResults() : 0,
            'schedules' => $teamId ? (new ScheduleModel())->groupStart()->where('team_a_id', $teamId)->orWhere('team_b_id', $teamId)->groupEnd()->findAll(5) : [],
        ]);
    }
}
