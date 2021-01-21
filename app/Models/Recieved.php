<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recieved extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'friends_id', 'name', 'list_no'];

    public function user()
    {
    	return belongsTo('App\Models\User', 'friends_id', 'id');
    }
}
