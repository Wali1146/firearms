<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|greater_than[0]',
        'price' => 'required|decimal'
    ];

    protected $validationMessages = [
        'order_id' => [
            'required' => 'Order ID is required',
            'integer' => 'Order ID must be a valid number'
        ],
        'product_id' => [
            'required' => 'Product ID is required',
            'integer' => 'Product ID must be a valid number'
        ],
        'quantity' => [
            'required' => 'Quantity is required',
            'integer' => 'Quantity must be a valid number',
            'greater_than' => 'Quantity must be greater than 0'
        ],
        'price' => [
            'required' => 'Price is required',
            'decimal' => 'Price must be a valid decimal number'
        ]
    ];

    public function getItemsForOrder($orderId)
    {
        return $this->select('order_items.*, products.name as product_name')
                    ->join('products', 'products.id = order_items.product_id')
                    ->where('order_id', $orderId)
                    ->findAll();
    }
}