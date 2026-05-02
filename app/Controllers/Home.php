<?php

namespace App\Controllers;

use App\Models\TournamentModel;

class Home extends BaseController
{
    public function index(): string
    {
        $template = ROOTPATH . 'template/html/index.html';

        if (is_file($template)) {
            $html = file_get_contents($template);
            $assetBase = rtrim(base_url('template/html/assets'), '/') . '/';

            $html = str_replace(
                ['href="assets/', 'src="assets/'],
                ['href="' . $assetBase, 'src="' . $assetBase],
                $html
            );

            $html = str_replace(
                [
                    '<title>Galactic | eSports and Gaming HTML5 Template</title>',
                    'href="index.html"',
                    'href="upcoming-matches.html"',
                    'href="contact.html"',
                    'Join Our Team',
                    'Join With Us',
                ],
                [
                    '<title>National Esports Tournament Platform</title>',
                    'href="' . site_url('/') . '"',
                    'href="' . site_url('tournaments') . '"',
                    'href="' . site_url('login') . '"',
                    'Login',
                    'เข้าสู่ระบบ',
                ],
                $html
            );

            return $html;
        }

        $tournaments = (new TournamentModel())->orderBy('start_at', 'ASC')->findAll(6);

        return view('public/home', [
            'title' => 'National Esports Tournament',
            'tournaments' => $tournaments,
        ]);
    }

    public function tournaments(): string
    {
        return view('public/tournaments', [
            'title' => 'รายการแข่งขัน',
            'tournaments' => (new TournamentModel())->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function show(int $id): string
    {
        $tournament = (new TournamentModel())->find($id);
        if (! $tournament) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/tournament_show', [
            'title' => $tournament['name'],
            'tournament' => $tournament,
        ]);
    }
}
