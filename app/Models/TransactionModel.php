<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|greater_than[0]',
        'status' => 'in_list[cart,purchased]'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a valid number'
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
        'status' => [
            'in_list' => 'Status must be either cart or purchased'
        ]
    ];

    public function getCartItems($userId)
    {
        return $this->select('transaction.*, products.name, products.price, products.description')
                    ->join('products', 'products.id = transaction.product_id')
                    ->where('user_id', $userId)
                    ->where('status', 'cart')
                    ->findAll();
    }

    public function getPurchaseHistory($userId)
    {
        return $this->select('transaction.*, products.name, products.price')
                    ->join('products', 'products.id = transaction.product_id')
                    ->where('user_id', $userId)
                    ->where('status', 'purchased')
                    ->findAll();
    }

    public function addToCart($userId, $productId, $quantity = 1)
    {
        // Check if item already exists in cart
        $existing = $this->where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->where('status', 'cart')
                        ->first();

        if ($existing) {
            // Update quantity
            return $this->update($existing['id'], [
                'quantity' => $existing['quantity'] + $quantity
            ]);
        } else {
            // Add new item
            return $this->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'status' => 'cart'
            ]);
        }
    }

    public function removeFromCart($userId, $productId)
    {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->where('status', 'cart')
                    ->delete();
    }

    public function clearCart($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'cart')
                    ->delete();
    }

    public function purchaseCart($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'cart')
                    ->set(['status' => 'purchased'])
                    ->update();
    }
}