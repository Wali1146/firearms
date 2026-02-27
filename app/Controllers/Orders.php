<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Orders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $isAdmin = session()->get('user_role') === 'admin';

        if ($isAdmin) {
            $orders = $this->orderModel->getOrdersWithUser();
        } else {
            $orders = $this->orderModel->getOrdersWithUser($userId);
        }

        $data = [
            'title' => 'My Orders - Rhys Firearms',
            'orders' => $orders,
            'is_admin' => $isAdmin
        ];

        return view('orders/index', $data);
    }

    public function show($orderId)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $isAdmin = session()->get('user_role') === 'admin';

        $order = $this->orderModel->getOrderWithItems($orderId);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Check if user owns this order or is admin
        if (!$isAdmin && $order['user_id'] != $userId) {
            return redirect()->to('/orders');
        }

        $data = [
            'title' => 'Order #' . $orderId . ' - Rhys Firearms',
            'order' => $order,
            'is_admin' => $isAdmin
        ];

        return view('orders/show', $data);
    }

    public function updateStatus($orderId)
    {
        if (!session()->get('user_id') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }

        $status = $this->request->getPost('status');
        $allowedStatuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];

        if (in_array($status, $allowedStatuses)) {
            if ($this->orderModel->update($orderId, ['status' => $status])) {
                session()->setFlashdata('success', 'Order status updated successfully');
            } else {
                session()->setFlashdata('error', 'Failed to update order status');
            }
        } else {
            session()->setFlashdata('error', 'Invalid status');
        }

        return redirect()->to('/orders/' . $orderId);
    }
}