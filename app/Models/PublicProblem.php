<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicProblem extends Model
{
    use HasFactory;
    	protected $fillable = ['problem', 'user_id'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function publicAnswer()
    {
    	return $this->hasMany('App\Models\PublicAnswer', 'problem_id', 'id');
    }
}
