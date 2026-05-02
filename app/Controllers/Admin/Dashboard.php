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

            $html = preg_replace(
                '#<ul class="sidemenu\s+page-header-fixed slimscroll-style".*?</ul>\s*</div>\s*</div>\s*</div>\s*<!-- end sidebar menu -->#s',
                $this->sidebarMenuHtml($assetBase) . "\n\t\t\t<!-- end sidebar menu -->",
                $html,
                1
            ) ?? $html;

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

    private function sidebarMenuHtml(string $assetBase): string
    {
        $items = [
            ['url' => site_url('adminz'), 'icon' => 'airplay', 'label' => 'Dashboard'],
            ['url' => site_url('adminz/tournaments'), 'icon' => 'award', 'label' => 'จัดการข้อมูลการแข่งขัน'],
            ['url' => site_url('adminz/tournaments/new'), 'icon' => 'plus-square', 'label' => 'เพิ่มการแข่งขัน'],
            ['url' => site_url('tournaments'), 'icon' => 'eye', 'label' => 'แสดงข้อมูลการแข่งขัน'],
            ['url' => site_url('adminz/people?role=team_manager'), 'icon' => 'briefcase', 'label' => 'จัดการข้อมูลผู้จัดการทีม'],
            ['url' => site_url('adminz/people?role=athletes'), 'icon' => 'users', 'label' => 'จัดการข้อมูลนักกีฬา'],
            ['url' => site_url('adminz/people?role=amateur_athlete'), 'icon' => 'user', 'label' => 'จัดการข้อมูลนักกีฬาทั่วไป'],
            ['url' => site_url('adminz/teams'), 'icon' => 'shield', 'label' => 'จัดการข้อมูลทีม'],
            ['url' => site_url('adminz/registrations'), 'icon' => 'clipboard', 'label' => 'จัดการข้อมูลผู้สมัครแข่งขัน'],
            ['url' => site_url('adminz/schedules'), 'icon' => 'calendar', 'label' => 'จัดการข้อมูลตารางแข่งขัน'],
            ['url' => site_url('adminz/reports'), 'icon' => 'bar-chart-2', 'label' => 'ออกรายงาน'],
        ];

        $menu = '';
        foreach ($items as $item) {
            $menu .= sprintf(
                "\n\t\t\t\t\t\t\t<li class=\"nav-item\"><a href=\"%s\" class=\"nav-link\"><i data-feather=\"%s\"></i><span class=\"title\">%s</span></a></li>",
                esc($item['url'], 'attr'),
                esc($item['icon'], 'attr'),
                esc($item['label'])
            );
        }

        $username = esc((string) $this->session->get('username'));
        $avatar = esc($assetBase . 'assets/img/dp.jpg', 'attr');

        return <<<HTML
			<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div class="left-sidemenu">
						<ul class="sidemenu page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
							<li class="sidebar-toggler-wrapper hide"><div class="sidebar-toggler"><span></span></div></li>
							<li class="sidebar-user-panel">
								<div class="sidebar-user">
									<div class="sidebar-user-picture"><img alt="image" src="{$avatar}"></div>
									<div class="sidebar-user-details">
										<div class="user-name">{$username}</div>
										<div class="user-role">Administrator</div>
									</div>
								</div>
							</li>{$menu}
						</ul>
					</div>
				</div>
			</div>
HTML;
    }
}
