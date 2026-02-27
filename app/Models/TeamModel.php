<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]|is_unique[teams.name,id,{id}]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Team name is required',
            'min_length' => 'Team name must be at least 2 characters',
            'max_length' => 'Team name cannot exceed 100 characters',
            'is_unique' => 'Team name already exists'
        ]
    ];
}