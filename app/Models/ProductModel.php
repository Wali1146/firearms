<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'type', 'category_id', 'team_id', 'price', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'type' => 'required|in_list[subscription,course,firearms]',
        'category_id' => 'required|integer',
        'team_id' => 'required|integer',
        'price' => 'required|decimal',
        'description' => 'permit_empty|max_length[1000]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Product name is required',
            'min_length' => 'Product name must be at least 3 characters',
            'max_length' => 'Product name cannot exceed 255 characters'
        ],
        'type' => [
            'required' => 'Product type is required',
            'in_list' => 'Product type must be subscription, course, or firearms'
        ],
        'category_id' => [
            'required' => 'Category is required',
            'integer' => 'Category ID must be a valid number'
        ],
        'team_id' => [
            'required' => 'Team is required',
            'integer' => 'Team ID must be a valid number'
        ],
        'price' => [
            'required' => 'Price is required',
            'decimal' => 'Price must be a valid decimal number'
        ],
        'description' => [
            'max_length' => 'Description cannot exceed 1000 characters'
        ]
    ];

    public function getProductsWithDetails()
    {
        return $this->select('products.*, category.name as category_name, teams.name as team_name')
                    ->join('category', 'category.id = products.category_id')
                    ->join('teams', 'teams.id = products.team_id')
                    ->findAll();
    }

    public function getProductWithDetails($id)
    {
        return $this->select('products.*, category.name as category_name, teams.name as team_name')
                    ->join('category', 'category.id = products.category_id')
                    ->join('teams', 'teams.id = products.team_id')
                    ->find($id);
    }

    public function getByType($type)
    {
        return $this->where('type', $type)->findAll();
    }

    public function getByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }
}