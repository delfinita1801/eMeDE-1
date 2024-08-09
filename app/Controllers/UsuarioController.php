<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        $model = new UserModel();

        $data = [
            'Nombre'     => $this->request->getPost('nombre'),
            'Apellido'   => $this->request->getPost('apellido'),
            'email'      => $this->request->getPost('email'),
            'contraseña' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_ad' => date('Y-m-d H:i:s')
        ];

        $model->save($data);

        return redirect()->to('/login')->with('msg', 'Usuario registrado exitosamente.');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['contraseña'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $sessionData = [
                    'id_usuario' => $data['id_usuario'],
                    'Nombre'     => $data['nombre'],
                    'Apellido'   => $data['apellido'],
                    'email'      => $data['email'],
                    'logged_in'  => TRUE
                ];
                $session->set($sessionData);
                return redirect()->to('/inicio');
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Correo no encontrado.');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}

   
