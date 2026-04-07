<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use CodeIgniter\RESTful\ResourceController;

class CartController extends ResourceController
{
    protected $modelName = 'App\Models\TransactionModel';
    protected $format    = 'json';

    public function showByUser($userId = null)
    {
        if ($userId === null) {
            return $this->fail('User ID tidak ditemukan', 400);
        }

        $data = $this->model->where('user_id', $userId)
                            ->where('status', 'cart')
                            ->findAll();
        return $this->respond($data);
    }

    public function create()
    {
        $model = new TransactionModel();
        $data = $this->request->getJSON(true);
        $data['status'] = 'cart';
        log_message('debug', 'Data masuk dari Flutter: ' . json_encode($data));

        if (!$model->insert($data)) {
            return $this->respond([
                'status' => 'error',
                'errors' => $model->errors()
            ], 400);
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Berhasil tambah ke keranjang'
        ]);
    }

    public function checkout($userId = null)
    {
        $this->model->where('user_id', $userId)
                    ->where('status', 'cart')
                    ->set(['status' => 'purchased'])
                    ->update();

        return $this->respond(['status' => 'success', 'message' => 'Transaksi selesai!']);
    }

    public function history($userId = null)
    {
        $data = $this->model->where('user_id', $userId)
                            ->where('status', 'purchased')
                            ->findAll();
        return $this->respond($data);
    }

    public function update($id = null)
    {
        $model = new TransactionModel();
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
            'message' => 'Transaksi berhasil diupdate'
        ]);
    }

    public function delete($id = null)
    {
        $model = new TransactionModel();

        if (!$model->delete($id)) {
            return $this->response->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus transaksi'
            ]);
        }

        return $this->response->setHeader('Access-Control-Allow-Origin', '*')->setJSON([
            'status' => 'success',
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }

}
