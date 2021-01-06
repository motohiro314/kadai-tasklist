<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status',
    
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',           
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     

    /**
     * このユーザが所有する投稿。（ Micropostモデルとの関係を定義）
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

  /**
     * このユーザに関係するモデルの件数をロードする。
     */
    /* function loadRelationshipCounts()
    {
        $this->loadCount('tasks');
    }*/
    
 


    

     function task()
    {
        return $this->hasMany(task::class);
    } 
    

  function loadRelationshipCounts()
   { 
        $this->loadCount('task');
    
   }   