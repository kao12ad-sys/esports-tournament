<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberProfileModel extends Model
{
    protected $table = 'member_profiles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'team_id', 'display_name', 'bio', 'birth_date', 'contact_channel', 'avatar',
        'social_facebook', 'social_line', 'social_instagram', 'social_x',
        'athlete_level', 'current_role', 'status',
    ];
}
