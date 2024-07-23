<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partylist extends Model
{
    use HasFactory;
    protected $table = 'partylist';

    protected $fillable = [
        'partylist_id',
        'name',
        'acronym',
    ];
}
