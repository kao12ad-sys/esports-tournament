<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\MemberProfileModel;
use App\Models\RegistrationModel;
use App\Models\ScheduleModel;
use App\Models\TeamModel;
use App\Models\TournamentModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $teamId = session('team_id');
        $userId = session('user_id');

        $registrationModel = new RegistrationModel();
        $scheduleModel = new ScheduleModel();

        $registrationBuilder = $registrationModel
            ->select('registrations.*, tournaments.name AS tournament_name, tournaments.game_name, tournaments.competition_type, tournaments.start_at')
            ->join('tournaments', 'tournaments.id = registrations.tournament_id');

        if ($teamId) {
            $registrationBuilder->groupStart()->where('registrations.team_id', $teamId)->orWhere('registrations.user_id', $userId)->groupEnd();
        } else {
            $registrationBuilder->where('registrations.user_id', $userId);
        }

        $registrations = $registrationBuilder->orderBy('registrations.created_at', 'DESC')->findAll(5);

        $statusCounts = ['pending' => 0, 'approved' => 0, 'rejected' => 0, 'withdrawn' => 0];
        foreach ($registrations as $registration) {
            if (isset($statusCounts[$registration['status']])) {
                $statusCounts[$registration['status']]++;
            }
        }

        $schedules = [];
        if ($teamId) {
            $schedules = $scheduleModel
                ->select('match_schedules.*, tournaments.name AS tournament_name, a.name AS team_a, b.name AS team_b')
                ->join('tournaments', 'tournaments.id = match_schedules.tournament_id')
                ->join('teams a', 'a.id = match_schedules.team_a_id', 'left')
                ->join('teams b', 'b.id = match_schedules.team_b_id', 'left')
                ->groupStart()->where('team_a_id', $teamId)->orWhere('team_b_id', $teamId)->groupEnd()
                ->orderBy('scheduled_at', 'ASC')
                ->findAll(5);
        }

        return view('member/dashboard', [
            'title' => 'โปรไฟล์สมาชิก',
            'team' => $teamId ? (new TeamModel())->find($teamId) : null,
            'profile' => (new MemberProfileModel())->where('user_id', $userId)->first(),
            'members' => $teamId ? (new UserModel())->where('team_id', $teamId)->where('role !=', 'admin')->findAll(8) : [],
            'registrations' => $registrations,
            'registrationTotal' => count($registrations),
            'statusCounts' => $statusCounts,
            'schedules' => $schedules,
            'openTournaments' => (new TournamentModel())->where('status', 'open')->orderBy('start_at', 'ASC')->findAll(4),
            'canRegisterTournament' => session('role') === 'team_manager',
        ]);
    }
}
