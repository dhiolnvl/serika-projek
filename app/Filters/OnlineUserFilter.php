<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Database\BaseConnection;

class OnlineUserFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $db = \Config\Database::connect();

        $ip = $request->getIPAddress();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $now = time();

        $db->table('online_users')->where('last_activity <', $now - 600)->delete();

        $existing = $db->table('online_users')
            ->where('ip_address', $ip)
            ->get()
            ->getRow();

        if ($existing) {

            $db->table('online_users')->where('ip_address', $ip)->update([
                'last_activity' => $now
            ]);
        } else {

            $db->table('online_users')->insert([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'last_activity' => $now
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
