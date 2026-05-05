<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationPlayerModel extends Model
{
    protected $table = 'registration_players';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['registration_id', 'user_id'];
}
