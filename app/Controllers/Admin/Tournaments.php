<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TournamentModel;

class Tournaments extends BaseController
{
    private TournamentModel $model;

    public function __construct()
    {
        $this->model = new TournamentModel();
    }

    public function index(): string
    {
        return view('admin/tournaments/index', ['title' => 'จัดการข้อมูลการแข่งขัน', 'items' => $this->model->orderBy('id', 'DESC')->findAll()]);
    }

    public function new(): string
    {
        return view('admin/tournaments/form', ['title' => 'เพิ่มการแข่งขัน', 'item' => []]);
    }

    public function create()
    {
        $data = $this->request->getPost([
            'name', 'game_name', 'competition_type', 'division', 'application_criteria',
            'rules', 'format', 'venue', 'registration_open_at', 'registration_close_at',
            'start_at', 'end_at', 'status',
        ]);

        if (! $this->model->insert($data)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->model->errors()));
        }

        return redirect()->to('/adminz/tournaments')->with('success', 'บันทึกข้อมูลการแข่งขันแล้ว');
    }

    public function edit($id): string
    {
        return view('admin/tournaments/form', ['title' => 'แก้ไขการแข่งขัน', 'item' => $this->model->find($id)]);
    }

    public function update($id)
    {
        $data = $this->request->getPost([
            'name', 'game_name', 'competition_type', 'division', 'application_criteria',
            'rules', 'format', 'venue', 'registration_open_at', 'registration_close_at',
            'start_at', 'end_at', 'status',
        ]);

        if (! $this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->model->errors()));
        }

        return redirect()->to('/adminz/tournaments')->with('success', 'อัปเดตข้อมูลการแข่งขันแล้ว');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/adminz/tournaments')->with('success', 'ลบข้อมูลแล้ว');
    }
}
