<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'team_id', 'username', 'email', 'password_hash', 'role', 'status', 'last_login_at',
    ];
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[80]',
        'email'    => 'required|valid_email|max_length[190]',
        'role'     => 'required|in_list[admin,team_manager,coach,amateur_athlete,pro_athlete]',
        'status'   => 'required|in_list[active,suspended]',
    ];
}
