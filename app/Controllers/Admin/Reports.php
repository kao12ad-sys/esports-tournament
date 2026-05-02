<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\ScheduleModel;
use App\Models\TeamModel;
use App\Models\TournamentModel;
use App\Models\UserModel;

class Reports extends BaseController
{
    public function index(): string
    {
        return view('admin/reports', [
            'title' => 'ออกรายงาน',
            'summary' => [
                'การแข่งขันทั้งหมด' => (new TournamentModel())->countAllResults(),
                'ทีมทั้งหมด' => (new TeamModel())->countAllResults(),
                'สมาชิกทั้งหมด' => (new UserModel())->where('role !=', 'admin')->countAllResults(),
                'ผู้สมัครแข่งขัน' => (new RegistrationModel())->countAllResults(),
                'แมตช์ในตาราง' => (new ScheduleModel())->countAllResults(),
            ],
            'registrations' => (new RegistrationModel())
                ->select('registrations.status, COUNT(*) AS total')
                ->groupBy('registrations.status')
                ->findAll(),
        ]);
    }
}
