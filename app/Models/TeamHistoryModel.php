<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamHistoryModel extends Model
{
    protected $table = 'team_histories';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'team_id', 'role', 'joined_at', 'left_at', 'note'];
}
