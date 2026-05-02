<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;

class Registrations extends BaseController
{
    public function index(): string
    {
        $items = (new RegistrationModel())
            ->select('registrations.*, tournaments.name AS tournament_name, teams.name AS team_name, users.username AS player_name')
            ->join('tournaments', 'tournaments.id = registrations.tournament_id')
            ->join('teams', 'teams.id = registrations.team_id', 'left')
            ->join('users', 'users.id = registrations.user_id', 'left')
            ->orderBy('registrations.id', 'DESC')
            ->findAll();

        return view('admin/registrations/index', ['title' => 'จัดการข้อมูลผู้สมัครแข่งขัน', 'items' => $items]);
    }

    public function update($id)
    {
        (new RegistrationModel())->update($id, [
            'status' => $this->request->getPost('status'),
            'note' => $this->request->getPost('note'),
        ]);

        return redirect()->back()->with('success', 'อัปเดตสถานะผู้สมัครแล้ว');
    }
}
