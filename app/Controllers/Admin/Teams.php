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
        return view('admin/simple_crud', [
            'title' => 'จัดการข้อมูลทีม',
            'route' => 'teams',
            'fields' => [
                'name' => 'ชื่อทีม',
                'tag' => 'ตัวย่อ',
                'contact_channel' => 'ช่องทางติดต่อ',
                'status' => 'สถานะ',
            ],
            'items' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        $this->model->insert($this->request->getPost(['name', 'tag', 'description', 'contact_channel', 'status']));

        return redirect()->back()->with('success', 'บันทึกทีมแล้ว');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->back()->with('success', 'ลบทีมแล้ว');
    }
}
