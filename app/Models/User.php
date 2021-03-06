<?php

namespace nullx27\Herald\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $casts = ['admin' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['character_id', 'name', 'owner_hash', 'refresh_token', 'corporation_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];
}
