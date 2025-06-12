<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_a';
    protected $allowedFields = ['username', 'password','nama','alamat','no_hp','role'];
}
