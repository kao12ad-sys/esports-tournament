<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\TournamentModel;

class Tournament extends BaseController
{
    public function index(): string
    {
        return view('member/tournaments', [
            'title' => 'สมัครและตรวจสอบการแข่งขัน',
            'tournaments' => (new TournamentModel())->orderBy('start_at', 'ASC')->findAll(),
            'registrations' => (new RegistrationModel())->where('team_id', session('team_id'))->orWhere('user_id', session('user_id'))->findAll(),
        ]);
    }

    public function register(int $id)
    {
        $tournament = (new TournamentModel())->find($id);
        if (! $tournament || $tournament['status'] !== 'open') {
            return redirect()->back()->with('error', 'รายการนี้ยังไม่เปิดรับสมัคร');
        }

        $data = [
            'tournament_id' => $id,
            'registered_by' => session('user_id'),
            'status' => 'pending',
            'note' => $this->request->getPost('note'),
        ];

        if ($tournament['competition_type'] === 'team') {
            if (! session('team_id')) {
                return redirect()->back()->with('error', 'ต้องมีทีมก่อนสมัครรายการประเภททีม');
            }
            $data['team_id'] = session('team_id');
        } else {
            $data['user_id'] = session('user_id');
        }

        (new RegistrationModel())->insert($data);

        return redirect()->back()->with('success', 'ส่งใบสมัครแล้ว รอผู้ดูแลอนุมัติ');
    }
}
