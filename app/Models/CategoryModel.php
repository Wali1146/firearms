<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'sort_order'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]|is_unique[category.name,id,{id}]',
        'sort_order' => 'integer'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Category name is required',
            'min_length' => 'Category name must be at least 2 characters',
            'max_length' => 'Category name cannot exceed 100 characters',
            'is_unique' => 'Category name already exists'
        ],
        'sort_order' => [
            'integer' => 'Sort order must be a valid number'
        ]
    ];

    public function getOrdered()
    {
        return $this->orderBy('sort_order', 'ASC')->findAll();
    }
}