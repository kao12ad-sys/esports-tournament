<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'tag', 'description', 'contact_channel', 'status'];
    protected $validationRules = [
        'name'   => 'required|max_length[150]',
        'tag'    => 'permit_empty|max_length[30]',
        'status' => 'required|in_list[active,inactive]',
    ];
}
