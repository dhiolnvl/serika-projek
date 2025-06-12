<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/loginAdmin');
        }

        $userRole = $session->get('role');

        if ($arguments && !in_array($userRole, $arguments)) {
            return redirect()->to('/unauth');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
