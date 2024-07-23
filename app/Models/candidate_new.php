<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidate_new extends Model
{
    use HasFactory;
    protected $table = 'candidates_new';

    protected $fillable = [
        'candidate_id',
        'first_name',
        'last_name',
        'middle_name',
        'party',
        'organization',
        'position',
        'college',
        'course',
    ];
}
