<?php

// app/Models/KeranjangModel.php
namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_ktg';
    protected $allowedFields = ['kategori'];
}
