<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Concerns\UsesUuid;
use App\Models\Confession;
use Webpatser\Uuid\Uuid;
use Cache;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    

     protected $guarded = []; // YOLO

     // protected $primaryKey="uuid";




 public $incrementing = false;


  protected $keyType = 'string';

  protected static function boot()
  {
    parent::boot();
 self::creating(function ($user) {
     $user->uuid = (string) Uuid::generate(4);
 });
  }

    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid',
        'karma',
        'gender',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function confessions()
    {
        return $this->hasMany('App\Models\Confession', 'confessionFrom', 'id');
    }

    public function sents()
    {
        return $this->hasMany('App\Models\sent', 'sender_id', 'id');
    }

    public function recieveds()
    {
        return $this->hasMany('App\Models\recieved', 'sender_id', 'id' );
    }

    public function publicProblems()
    {
        return $this->hasMany('App\Models\PublicProblem', 'user_id', 'id');
    }
    
     public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    } 
}
