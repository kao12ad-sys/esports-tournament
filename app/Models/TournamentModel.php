<?php

namespace App\Models;

use CodeIgniter\Model;

class TournamentModel extends Model
{
    protected $table = 'tournaments';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'name', 'game_name', 'competition_type', 'division', 'min_players', 'max_players', 'application_criteria',
        'rules', 'format', 'venue', 'registration_open_at', 'registration_close_at',
        'start_at', 'end_at', 'status',
    ];
    protected $validationRules = [
        'name'             => 'required|max_length[190]',
        'game_name'        => 'required|max_length[120]',
        'competition_type' => 'required|in_list[solo,team]',
        'division'         => 'permit_empty|max_length[120]',
        'min_players'      => 'permit_empty|integer|greater_than_equal_to[1]',
        'max_players'      => 'permit_empty|integer|greater_than_equal_to[1]',
        'status'           => 'required|in_list[draft,open,closed,running,finished]',
    ];
}
