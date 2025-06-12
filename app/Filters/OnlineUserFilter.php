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
        $db = \Config\Database::connect();

        $ip = $request->getIPAddress();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $now = time();

        // Hapus data lama (lebih dari 3 menit)
        $db->table('online_users')->where('last_activity <', $now - 180)->delete();

        // Cek apakah user ini sudah ada
        $existing = $db->table('online_users')
            ->where('ip_address', $ip)
            ->get()
            ->getRow();

        if ($existing) {
            // Update waktu aktivitas terakhir
            $db->table('online_users')->where('ip_address', $ip)->update([
                'last_activity' => $now
            ]);
        } else {
            // Tambah data baru
            $db->table('online_users')->insert([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'last_activity' => $now
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
