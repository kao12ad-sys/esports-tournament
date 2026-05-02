<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table = 'match_schedules';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'tournament_id', 'round_name', 'match_no', 'team_a_id', 'team_b_id',
        'scheduled_at', 'venue', 'score_a', 'score_b', 'winner_team_id', 'status',
    ];
}
