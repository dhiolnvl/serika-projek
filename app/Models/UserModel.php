<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_u';
    protected $allowedFields = ['username','password','nama','alamat','no_hp','role'];
}
