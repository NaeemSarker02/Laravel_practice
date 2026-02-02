<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name','email','password','role_id'];

    protected $hidden = ['password'];

    // A user belongs to a role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Posts by this user
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Comments by this user
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Helper
    public function isSuperAdmin()
    {
        return $this->role && $this->role->name === 'super_admin';
    }
}
