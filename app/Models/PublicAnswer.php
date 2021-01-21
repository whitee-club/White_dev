<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answer', 'problem_id', 'answered_by', 'deleted', 'response', 'problem', 'asked_by'];

    public function publicProblem()
    {
    	return $this->belongsTo('App\Models\PublicProblem', 'problem_id', 'id');
    }
}
