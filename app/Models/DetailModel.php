<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
    protected $table = 'pemesanan_detail';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = [
        'id_p',
        'id_ktg',
        'jenis',
        'model',
        'ukuran',
        'lengan',
        'jumlah',
        'harga',
        'status'
    ];
}
