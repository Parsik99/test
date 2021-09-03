<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectsModel extends Model
{
    protected $table = 'subjects';
    protected $allowedFields = [
        'name',
    ];
}