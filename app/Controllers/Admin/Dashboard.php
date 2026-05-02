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
        $template = ROOTPATH . 'templates/source/index.html';

        if (is_file($template)) {
            $html = file_get_contents($template);
            $assetBase = rtrim(base_url('templates/source'), '/') . '/';

            $html = str_replace(
                ['href="assets/', 'src="assets/', 'href="fonts/', 'src="fonts/', 'href="css/', 'src="js/'],
                [
                    'href="' . $assetBase . 'assets/',
                    'src="' . $assetBase . 'assets/',
                    'href="' . $assetBase . 'fonts/',
                    'src="' . $assetBase . 'fonts/',
                    'href="' . $assetBase . 'css/',
                    'src="' . $assetBase . 'js/',
                ],
                $html
            );

            $html = str_replace(
                [
                    '<title>Smart University | Bootstrap Responsive Admin Template</title>',
                    '<span class="logo-default">Smart</span>',
                    'href="index.html"',
                    'href="login.html"',
                    'Smart University',
                ],
                [
                    '<title>Adminz | National Esports Tournament</title>',
                    '<span class="logo-default">Adminz</span>',
                    'href="' . site_url('adminz') . '"',
                    'href="' . site_url('adminz/logout') . '"',
                    'National Esports',
                ],
                $html
            );

            return $html;
        }

        return view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'counts' => [
                'tournaments' => (new TournamentModel())->countAllResults(),
                'teams' => (new TeamModel())->countAllResults(),
                'members' => (new UserModel())->where('role !=', 'admin')->countAllResults(),
                'registrations' => (new RegistrationModel())->countAllResults(),
                'schedules' => (new ScheduleModel())->countAllResults(),
            ],
        ]);
    }
}
