<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use App\Models\TeamModel;
use App\Models\TournamentModel;

class Schedules extends BaseController
{
    private ScheduleModel $model;

    public function __construct()
    {
        $this->model = new ScheduleModel();
    }

    public function index(): string
    {
        $items = $this->model
            ->select('match_schedules.*, tournaments.name AS tournament_name, a.name AS team_a, b.name AS team_b')
            ->join('tournaments', 'tournaments.id = match_schedules.tournament_id')
            ->join('teams a', 'a.id = match_schedules.team_a_id', 'left')
            ->join('teams b', 'b.id = match_schedules.team_b_id', 'left')
            ->orderBy('scheduled_at', 'ASC')
            ->findAll();

        return view('admin/schedules/index', [
            'title' => 'จัดการข้อมูลตารางแข่งขัน',
            'items' => $items,
            'teams' => (new TeamModel())->findAll(),
            'tournaments' => (new TournamentModel())->findAll(),
        ]);
    }

    public function create()
    {
        $this->model->insert($this->request->getPost([
            'tournament_id', 'round_name', 'match_no', 'team_a_id', 'team_b_id',
            'scheduled_at', 'venue', 'score_a', 'score_b', 'winner_team_id', 'status',
        ]));

        return redirect()->back()->with('success', 'เพิ่มตารางแข่งขันแล้ว');
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost([
            'score_a', 'score_b', 'winner_team_id', 'status',
        ]));

        return redirect()->back()->with('success', 'อัปเดตผลการแข่งขันแล้ว');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->back()->with('success', 'ลบตารางแข่งขันแล้ว');
    }
}
