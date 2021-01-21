<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recieved;

class Message extends Model
{
    use HasFactory;

     protected $fillable = ['from', 'to', 'text', 'list_no'];

     public function fromContact()
    {
        return $this->hasOne('App\Models\Recieved', 'friends_id', 'from');
    }
}
