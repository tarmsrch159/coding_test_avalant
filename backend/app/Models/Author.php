<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Author extends Authenticatable
{   
    use HasApiTokens, HasFactory, Notifiable;
    //
    protected $fillable = [
        'name',
        'password',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'author_id');
    }
}
