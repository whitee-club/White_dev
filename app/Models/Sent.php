<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sent extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'name', 'list_no', 'friends_id'];

    	public function user()
    {
    	return belongsTo('App\Models\User', 'friends_id', 'id');
    }
}
