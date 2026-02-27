<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'total', 'status', 'shipping_name', 'shipping_email',
        'shipping_address', 'shipping_city', 'shipping_state', 'shipping_zip'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'total' => 'required|decimal',
        'status' => 'in_list[pending,processing,shipped,completed,cancelled]',
        'shipping_name' => 'required|max_length[255]',
        'shipping_email' => 'required|valid_email|max_length[255]',
        'shipping_address' => 'required|max_length[1000]',
        'shipping_city' => 'required|max_length[100]',
        'shipping_state' => 'required|max_length[100]',
        'shipping_zip' => 'required|max_length[20]'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a valid number'
        ],
        'total' => [
            'required' => 'Total amount is required',
            'decimal' => 'Total must be a valid decimal number'
        ],
        'status' => [
            'in_list' => 'Status must be one of: pending, processing, shipped, completed, cancelled'
        ],
        'shipping_name' => [
            'required' => 'Shipping name is required',
            'max_length' => 'Shipping name cannot exceed 255 characters'
        ],
        'shipping_email' => [
            'required' => 'Shipping email is required',
            'valid_email' => 'Please enter a valid email address',
            'max_length' => 'Shipping email cannot exceed 255 characters'
        ],
        'shipping_address' => [
            'required' => 'Shipping address is required',
            'max_length' => 'Shipping address cannot exceed 1000 characters'
        ],
        'shipping_city' => [
            'required' => 'Shipping city is required',
            'max_length' => 'Shipping city cannot exceed 100 characters'
        ],
        'shipping_state' => [
            'required' => 'Shipping state is required',
            'max_length' => 'Shipping state cannot exceed 100 characters'
        ],
        'shipping_zip' => [
            'required' => 'Shipping zip code is required',
            'max_length' => 'Shipping zip code cannot exceed 20 characters'
        ]
    ];

    public function getOrdersWithUser($userId = null)
    {
        $builder = $this->select('orders.*, users.username, users.email')
                       ->join('users', 'users.id = orders.user_id');

        if ($userId) {
            $builder->where('orders.user_id', $userId);
        }

        return $builder->findAll();
    }

    public function getOrderWithItems($orderId)
    {
        $order = $this->find($orderId);
        if (!$order) return null;

        $orderItemsModel = new OrderItemModel();
        $order['items'] = $orderItemsModel->getItemsForOrder($orderId);

        return $order;
    }
}