<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('isLoggedIn')) {
            $path = '/' . trim($request->getUri()->getPath(), '/');
            $loginUrl = str_contains($path, '/adminz')
                ? '/adminz/login'
                : '/login';

            return redirect()->to($loginUrl)->with('error', 'กรุณาเข้าสู่ระบบก่อนใช้งาน');
        }

        if ($arguments !== null && $arguments !== []) {
            $allowed = array_map('trim', $arguments);
            if (! in_array($session->get('role'), $allowed, true)) {
                return redirect()->to('/member')->with('error', 'บัญชีนี้ไม่มีสิทธิ์เข้าถึงหน้านี้');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
