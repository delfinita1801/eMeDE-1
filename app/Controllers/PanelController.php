<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConsumoModel;
use App\Models\casamodel;

class PanelController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $consumoModel = new ConsumoModel();
        $dispositivoModel = new casamodel();
        $id_usuario = $session->get('id_usuario');
        
        $data['consumos'] = $consumoModel->where('id_usuario', $id_usuario)->findAll();
        $data['casas'] = $dispositivoModel->findAll();
        
        return view('panel', $data);
    }

    public function inicio()
    {
        return view('inicio');
    }

    public function casas()
    {
        return view('casas');
        
    }

    public function consumo()
    {
        return view('consumo');
    }
}
