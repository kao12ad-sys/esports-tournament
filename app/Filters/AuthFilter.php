<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

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

        if ($session->get('role') === 'staff' && strtoupper($request->getMethod()) === 'DELETE') {
            return redirect()->back()->with('error', 'บัญชี Staff ไม่มีสิทธิ์ลบข้อมูล');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $path = '/' . trim($request->getUri()->getPath(), '/');
        if (session('role') !== 'staff' || ! str_contains($path, '/adminz')) {
            return;
        }

        $body = $response->getBody();
        if (! is_string($body) || ! str_contains($body, '</body>')) {
            return;
        }

        $script = <<<'HTML'
<script>
document.querySelectorAll('form').forEach(function (form) {
    if (form.querySelector('input[name="_method"][value="DELETE"]')) {
        form.style.display = 'none';
    }
});
</script>
HTML;
        $response->setBody(str_replace('</body>', $script . '</body>', $body));
    }
}
