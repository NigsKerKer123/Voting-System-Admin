<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voters extends Model
{
    use HasFactory;
    protected $table = 'voters';

    protected $fillable = [
        'student_id',
        'name',
        'reference_key',
        'email',
        'course',
        'college',
        'passkey',
        'vote_casted',
    ];

    protected $hidden = [
        'passkey',
    ];
}
