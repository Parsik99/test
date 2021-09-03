<?php

namespace App\Models;

use CodeIgniter\Model;

class SupervisoryAuthoritiesModel extends Model
{
    protected $table = 'supervisory_authorities';
    protected $allowedFields = [
        'name',
    ];
}