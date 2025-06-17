<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table = 'stok';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis', 'gambar', 'stok', 'id_ktg'];
}
