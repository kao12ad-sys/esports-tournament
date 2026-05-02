<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session('role');
        $allowed = $arguments === null ? [] : array_map('trim', $arguments);

        if ($allowed !== [] && ! in_array($role, $allowed, true)) {
            return redirect()->back()->with('error', 'ไม่มีสิทธิ์ดำเนินการ');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
