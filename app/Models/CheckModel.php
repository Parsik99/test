<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckModel extends Model
{
    protected $table = 'checks';
    protected $allowedFields = [
        'subject_id',
        'authority_id',
        'start_date',
        'finish_date',
        'duration',
    ];
}