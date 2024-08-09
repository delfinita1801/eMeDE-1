<?php

namespace App\Models;

use CodeIgniter\Model;

class barriomodel extends Model
{
    protected $table      = 'barrio';
    protected $primaryKey = 'id_barrio';
    protected $allowedFields = ['nombre_barrio']; 
}