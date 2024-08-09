<?php

namespace App\Models;

use CodeIgniter\Model;

class CasaModel extends Model
{
    protected $table = 'casas';
    protected $primaryKey = 'id_casa';
    protected $allowedFields = ['nombre_casa', 'id_direccion', 'id_ciudad', 'consumo', 'id_barrio'];

    public function getCasasWithDetails()
    {
        return $this->select('casas.*, direcciones.calle, direcciones.numero, ciudades.nombre_ciudad, barrio.nombre_barrio')
                    ->join('direcciones', 'direcciones.id_direccion = casas.id_direccion')
                    ->join('ciudades', 'ciudades.id_ciudad = direcciones.id_ciudad')
                    ->join('barrio','barrio.id_barrio = casas.id_barrio')
                    ->findAll();
    }
}