<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class Teams extends BaseController
{
    private TeamModel $model;

    public function __construct()
    {
        $this->model = new TeamModel();
    }

    public function index(): string
    {
        return view('admin/teams/index', [
            'title' => 'จัดการข้อมูลทีม',
            'items' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        $this->model->insert($this->request->getPost(['name', 'tag', 'description', 'contact_channel', 'status']));

        return redirect()->back()->with('success', 'บันทึกทีมแล้ว');
    }

    public function update($id)
    {
        if (! $this->model->find($id)) {
            return redirect()->back()->with('error', 'Team not found');
        }

        $this->model->update($id, [
            'name' => $this->request->getPost('name'),
            'tag' => $this->request->getPost('tag'),
            'description' => $this->request->getPost('description'),
            'contact_channel' => $this->request->getPost('contact_channel'),
            'status' => $this->request->getPost('status') ?: 'active',
        ]);

        return redirect()->back()->with('success', 'Updated team details');
    }

    public function delete($id)
    {
        if (session('role') === 'staff') {
            return redirect()->back()->with('error', 'บัญชี Staff ไม่มีสิทธิ์ลบข้อมูล');
        }

        $this->model->delete($id);

        return redirect()->back()->with('success', 'ลบทีมแล้ว');
    }
}
