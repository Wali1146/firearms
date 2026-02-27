<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Checkout extends BaseController
{
    protected $transactionModel;
    protected $orderModel;
    protected $orderItemModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $cartItems = $this->transactionModel->getCartItems($userId);

        if (empty($cartItems)) {
            return redirect()->to('/cart');
        }

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $data = [
            'title' => 'Checkout - Rhys Firearms',
            'cart_items' => $cartItems,
            'total' => $total
        ];

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'shipping_name' => 'required|max_length[255]',
                'shipping_email' => 'required|valid_email|max_length[255]',
                'shipping_address' => 'required|max_length[1000]',
                'shipping_city' => 'required|max_length[100]',
                'shipping_state' => 'required|max_length[100]',
                'shipping_zip' => 'required|max_length[20]',
                'payment_method' => 'required|in_list[credit_card]'
            ];

            if ($this->validate($rules)) {
                // Create order
                $orderData = [
                    'user_id' => $userId,
                    'total' => $total,
                    'status' => 'pending',
                    'shipping_name' => $this->request->getPost('shipping_name'),
                    'shipping_email' => $this->request->getPost('shipping_email'),
                    'shipping_address' => $this->request->getPost('shipping_address'),
                    'shipping_city' => $this->request->getPost('shipping_city'),
                    'shipping_state' => $this->request->getPost('shipping_state'),
                    'shipping_zip' => $this->request->getPost('shipping_zip')
                ];

                $orderId = $this->orderModel->insert($orderData);

                if ($orderId) {
                    // Add order items
                    foreach ($cartItems as $item) {
                        $this->orderItemModel->insert([
                            'order_id' => $orderId,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ]);
                    }

                    // Clear cart and mark as purchased
                    $this->transactionModel->purchaseCart($userId);

                    session()->setFlashdata('success', 'Order placed successfully!');
                    return redirect()->to('/orders/' . $orderId);
                } else {
                    session()->setFlashdata('error', 'Failed to place order');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('checkout/index', $data);
    }
}