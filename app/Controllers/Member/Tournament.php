<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\RegistrationPlayerModel;
use App\Models\RegistrationModel;
use App\Models\TournamentModel;
use App\Models\UserModel;

class Tournament extends BaseController
{
    public function show(int $id): string
    {
        $tournament = (new TournamentModel())->find($id);
        if (! $tournament) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('member/tournament_show', [
            'title' => $tournament['name'],
            'tournament' => $tournament,
        ]);
    }

    public function index(): string
    {
        $teamId = session('team_id');

        return view('member/tournaments', [
            'title' => 'สมัครและตรวจสอบการแข่งขัน',
            'tournaments' => (new TournamentModel())->orderBy('start_at', 'ASC')->findAll(),
            'registrations' => (new RegistrationModel())->where('team_id', $teamId)->orWhere('user_id', session('user_id'))->findAll(),
            'canRegisterTournament' => $this->canRegisterTournament(),
            'teamAthletes' => $teamId ? (new UserModel())
                ->where('team_id', $teamId)
                ->whereIn('role', ['amateur_athlete', 'pro_athlete'])
                ->where('status', 'active')
                ->orderBy('username', 'ASC')
                ->findAll() : [],
        ]);
    }

    public function register(int $id)
    {
        if (! $this->canRegisterTournament()) {
            return redirect()->back()->with('error', 'เฉพาะผู้จัดการทีมเท่านั้นที่สามารถสมัครการแข่งขันได้');
        }

        $tournament = (new TournamentModel())->find($id);
        if (! $tournament || $tournament['status'] !== 'open') {
            return redirect()->back()->with('error', 'รายการนี้ยังไม่เปิดรับสมัคร');
        }

        $registrationModel = new RegistrationModel();
        $existing = $registrationModel
            ->where('tournament_id', $id)
            ->groupStart()
                ->where('team_id', session('team_id'))
                ->orWhere('user_id', session('user_id'))
            ->groupEnd()
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'ทีมนี้สมัครรายการนี้แล้ว');
        }

        $athleteIds = array_values(array_unique(array_map('intval', (array) $this->request->getPost('athlete_ids'))));
        $minPlayers = max(1, (int) ($tournament['min_players'] ?? 1));
        $maxPlayers = max($minPlayers, (int) ($tournament['max_players'] ?? $minPlayers));

        if (count($athleteIds) < $minPlayers) {
            return redirect()->back()->with('error', 'จำนวนนักกีฬาไม่ครบตามที่กำหนด ต้องเลือกอย่างน้อย ' . $minPlayers . ' คน');
        }

        if (count($athleteIds) > $maxPlayers) {
            return redirect()->back()->with('error', 'เลือกนักกีฬาได้ไม่เกิน ' . $maxPlayers . ' คน');
        }

        $validAthletes = (new UserModel())
            ->where('team_id', session('team_id'))
            ->whereIn('role', ['amateur_athlete', 'pro_athlete'])
            ->where('status', 'active')
            ->whereIn('id', $athleteIds ?: [0])
            ->findAll();

        if (count($validAthletes) !== count($athleteIds)) {
            return redirect()->back()->with('error', 'รายชื่อนักกีฬาที่เลือกไม่ถูกต้อง');
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

        $registrationId = $registrationModel->insert($data);

        if ($registrationId) {
            $rows = array_map(static fn ($athleteId) => [
                'registration_id' => $registrationId,
                'user_id' => $athleteId,
            ], $athleteIds);
            (new RegistrationPlayerModel())->insertBatch($rows);
        }

        return redirect()->back()->with('success', 'ส่งใบสมัครแล้ว รอผู้ดูแลอนุมัติ');
    }

    public function cancel(int $id)
    {
        if (! $this->canRegisterTournament()) {
            return redirect()->back()->with('error', 'เฉพาะผู้จัดการทีมเท่านั้นที่สามารถยกเลิกการสมัครได้');
        }

        $model = new RegistrationModel();

        // Find the registration for this team/user and tournament
        $reg = $model
            ->where('tournament_id', $id)
            ->groupStart()
                ->where('team_id', session('team_id'))
                ->orWhere('user_id', session('user_id'))
            ->groupEnd()
            ->first();

        if (! $reg) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลการสมัครที่จะยกเลิก');
        }

        if ($reg['status'] === 'approved') {
            return redirect()->back()->with('error', 'ไม่สามารถยกเลิกการสมัครที่ได้รับการอนุมัติแล้ว กรุณาติดต่อผู้ดูแลระบบ');
        }

        $cancelReason = (string) $this->request->getPost('cancel_reason');
        $otherReason  = (string) $this->request->getPost('cancel_reason_other');

        if ($cancelReason === 'other') {
            $reason = trim($otherReason);
        } else {
            $reason = $cancelReason;
        }

        if (empty($reason)) {
            return redirect()->back()->with('error', 'กรุณาระบุเหตุผลในการยกเลิก');
        }

        $model->delete($reg['id']);

        return redirect()->back()->with('success', 'ยกเลิกการสมัครแข่งขันเรียบร้อย เหตุผล: ' . esc($reason));
    }

    private function canRegisterTournament(): bool
    {
        return session('role') === 'team_manager';
    }
}
