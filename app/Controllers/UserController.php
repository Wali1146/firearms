<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $model = new UserModel();
        $data = $this->request->getJSON(true);

        if (!$model->insert($data)) {
            return $this->response->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
                'status' => 'error',
                'errors' => $model->errors()
            ]);
        }

        return $this->response->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
            'status' => 'success',
            'message' => 'User berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $model = new UserModel();
        $data = $this->request->getJSON(true);

        if (!$model->update($id, $data)) {
            return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
                'status' => 'error',
                'errors' => $model->errors()
            ]);
        }

        return $this->response
        ->setHeader('Access-Control-Allow-Origin', '*')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
        ->setJSON([
            'status' => 'success',
            'message' => 'User berhasil diupdate'
        ]);
    }

    public function delete($id = null)
    {
        $model = new UserModel();

        if (!$model->delete($id)) {
            return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
                'status' => 'error',
                'errors' => $model->errors()
            ]);
        }

        return $this->response
        ->setHeader('Access-Control-Allow-Origin', '*')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
        ->setJSON([
            'status' => 'success',
            'message' => 'User berhasil dihapus'
        ]);
    }
}
