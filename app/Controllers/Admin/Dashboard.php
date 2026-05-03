<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\ScheduleModel;
use App\Models\TeamModel;
use App\Models\TournamentModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $tournamentModel = new TournamentModel();
        $teamModel = new TeamModel();
        $userModel = new UserModel();
        $registrationModel = new RegistrationModel();
        $scheduleModel = new ScheduleModel();

        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'counts' => [
                'การแข่งขันทั้งหมด' => $tournamentModel->countAllResults(),
                'ทีมทั้งหมด' => $teamModel->countAllResults(),
                'สมาชิกทั้งหมด' => $userModel->where('role !=', 'admin')->countAllResults(),
                'ผู้สมัครแข่งขัน' => $registrationModel->countAllResults(),
                'ตารางแข่งขัน' => $scheduleModel->countAllResults(),
                'รออนุมัติ' => $registrationModel->where('status', 'pending')->countAllResults(),
            ],
            'tournaments' => $tournamentModel->orderBy('created_at', 'DESC')->findAll(5),
            'registrations' => $registrationModel
                ->select('registrations.*, tournaments.name AS tournament_name, teams.name AS team_name, users.username AS player_name')
                ->join('tournaments', 'tournaments.id = registrations.tournament_id')
                ->join('teams', 'teams.id = registrations.team_id', 'left')
                ->join('users', 'users.id = registrations.user_id', 'left')
                ->orderBy('registrations.created_at', 'DESC')
                ->findAll(5),
            'schedules' => $scheduleModel
                ->select('match_schedules.*, tournaments.name AS tournament_name, a.name AS team_a, b.name AS team_b')
                ->join('tournaments', 'tournaments.id = match_schedules.tournament_id')
                ->join('teams a', 'a.id = match_schedules.team_a_id', 'left')
                ->join('teams b', 'b.id = match_schedules.team_b_id', 'left')
                ->orderBy('scheduled_at', 'ASC')
                ->findAll(5),
        ]);
    }
}
