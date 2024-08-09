<?php

namespace App\Models;

use CodeIgniter\Model;

class CiudadModel extends Model
{
    protected $table      = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    protected $allowedFields = ['nombre_ciudad']; 
}