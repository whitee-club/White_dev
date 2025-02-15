<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Confession extends Model
{
    use HasFactory;

    Protected $fillable = ['confessionFrom', 'confessedTo', 'name', 'confession'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'confessionFrom', 'id');
    }
}
