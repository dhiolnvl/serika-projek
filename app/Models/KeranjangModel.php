<?php

// app/Models/KeranjangModel.php
namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_k';
    protected $allowedFields = ['id_u', 'jenis', 'model', 'ukuran', 'lengan', 'jumlah', 'harga'];
}
