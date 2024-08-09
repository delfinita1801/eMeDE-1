<?php

namespace App\Models;

use CodeIgniter\Model;

class DireccionModel extends Model
{
    protected $table      = 'direcciones';
    protected $primaryKey = 'id_direccion';
    protected $allowedFields = ['id_ciudad', 'numero', 'calle']; 
}