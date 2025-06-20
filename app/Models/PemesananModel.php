<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_p';
    protected $allowedFields = ['id_u', 'nama', 'alamat', 'no_hp', 'total', 'tanggal_pemesanan'];
}
