<?php

namespace App\Controllers;

use App\Models\CasaModel;
use App\Models\DireccionModel;
use App\Models\CiudadModel;
use CodeIgniter\Controller;
use App\Models\barriomodel;

class CasasController extends Controller
{
    public function index()
    {
        $model = new CasaModel();
        $data['casas'] = $model->getCasasWithDetails();

        return view('casas', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $casaModel = new CasaModel();
        $direccionModel = new DireccionModel();
        $ciudadModel = new CiudadModel();
        $barrioModel = new BarrioModel(); // Nuevo modelo para barrios
    
        // Obtener el nombre de la ciudad ingresada por el usuario
        $nombre_ciudad = $this->request->getPost('ciudad');
    
        // Verificar si la ciudad ya existe en la base de datos
        $ciudad = $ciudadModel->where('nombre_ciudad', $nombre_ciudad)->first();
        if (!$ciudad) {
            // Si no existe, crear una nueva entrada de ciudad
            $ciudadModel->save(['nombre_ciudad' => $nombre_ciudad]);
            $id_ciudad = $ciudadModel->insertID();
        } else {
            // Si existe, usar el ID de la ciudad existente
            $id_ciudad = $ciudad['id_ciudad'];
        }
    
        // Obtener el nombre del barrio ingresado por el usuario
        $nombre_barrio = $this->request->getPost('barrio');
    
        // Verificar si el barrio ya existe en la base de datos
        $barrio = $barrioModel->where('nombre_barrio', $nombre_barrio)->first();
        if (!$barrio) {
            // Si no existe, crear una nueva entrada de barrio
            $barrioModel->save(['nombre_barrio' => $nombre_barrio]);
            $id_barrio = $barrioModel->insertID();
        } else {
            // Si existe, usar el ID del barrio existente
            $id_barrio = $barrio['id_barrio'];
        }
    
        // Crear la dirección con el ID de la ciudad correspondiente
        $dataDireccion = [
            'calle' => $this->request->getPost('direccion'),
            'numero' => $this->request->getPost('numero'),
            'id_ciudad' => $id_ciudad,
            'id_barrio' => $id_barrio // Nuevo campo para el ID del barrio
        ];
        $direccionModel->save($dataDireccion);
        $id_direccion = $direccionModel->insertID();
    
        // Crear la casa con el ID de la dirección correspondiente
        $dataCasa = [
            'nombre_casa' => $this->request->getPost('nombre'),
            'id_direccion' => $id_direccion,
            'id_ciudad' => $id_ciudad
        ];
    
        if ($casaModel->save($dataCasa)) {
            return redirect()->to('/casas');
        } else {
            log_message('error', 'Error al guardar los datos: ' . implode(' ', $casaModel->errors()));
            echo "Error al guardar los datos.";
        }
    }
    
    public function edit($id)
    {
        $model = new CasaModel();
        $data['casa'] = $model->find($id);
    
        return view('edit', $data);
    }
    
    public function update($id)
    {
        $casaModel = new CasaModel();
        $direccionModel = new DireccionModel();
        $ciudadModel = new CiudadModel();
        $barrioModel = new BarrioModel();
    
        // Obtener el nombre de la ciudad ingresada por el usuario
        $nombre_ciudad = $this->request->getPost('ciudad');
    
        // Verificar si la ciudad ya existe en la base de datos
        $ciudad = $ciudadModel->where('nombre_ciudad', $nombre_ciudad)->first();
        if (!$ciudad) {
            // Si no existe, crear una nueva entrada de ciudad
            $ciudadModel->save(['nombre_ciudad' => $nombre_ciudad]);
            $id_ciudad = $ciudadModel->insertID();
        } else {
            // Si existe, usar el ID de la ciudad existente
            $id_ciudad = $ciudad['id_ciudad'];
        }
    
        // Obtener el nombre del barrio ingresado por el usuario
        $nombre_barrio = $this->request->getPost('barrio');
    
        // Verificar si el barrio ya existe en la base de datos
        $barrio = $barrioModel->where('nombre_barrio', $nombre_barrio)->first();
        if (!$barrio) {
            // Si no existe, crear una nueva entrada de barrio
            $barrioModel->save(['nombre_barrio' => $nombre_barrio]);
            $id_barrio = $barrioModel->insertID();
        } else {
            // Si existe, usar el ID del barrio existente
            $id_barrio = $barrio['id_barrio'];
        }
    
        // Actualizar la dirección con el ID de la ciudad y el ID del barrio correspondiente
        $dataDireccion = [
            'calle' => $this->request->getPost('calle'),
            'numero' => $this->request->getPost('numero'),
            'id_ciudad' => $id_ciudad,
            'id_barrio' => $id_barrio
        ];
        $direccionModel->update($this->request->getPost('id_direccion'), $dataDireccion);
    
        // Actualizar la casa con el ID de la dirección correspondiente
        $dataCasa = [
            'nombre_casa' => $this->request->getPost('nombre'),
            'id_direccion' => $this->request->getPost('id_direccion'),
            'id_ciudad' => $id_ciudad
        ];
    
        if ($casaModel->update($id, $dataCasa)) {
            return redirect()->to('/casas');
        } else {
            log_message('error', 'Error al actualizar los datos: ' . implode(' ', $casaModel->errors()));
            echo "Error al actualizar los datos.";
        }
    }
    public function delete($id)
    {
        $model = new CasaModel();
        $model->delete($id);

        return redirect()->to('/casas');
    }

    
}