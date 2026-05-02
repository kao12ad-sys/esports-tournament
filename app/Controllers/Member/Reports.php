<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\ScheduleModel;

class Reports extends BaseController
{
    public function index(): string
    {
        $teamId = session('team_id');

        return view('member/reports', [
            'title' => 'รายงานทีม',
            'registrations' => $teamId ? (new RegistrationModel())
                ->select('registrations.*, tournaments.name AS tournament_name')
                ->join('tournaments', 'tournaments.id = registrations.tournament_id')
                ->where('team_id', $teamId)
                ->findAll() : [],
            'schedules' => $teamId ? (new ScheduleModel())
                ->groupStart()->where('team_a_id', $teamId)->orWhere('team_b_id', $teamId)->groupEnd()
                ->orderBy('scheduled_at', 'ASC')
                ->findAll() : [],
        ]);
    }
}
