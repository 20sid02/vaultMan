<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vault extends Model
{
    use HasFactory;

    protected $table = 'vaults';

    protected $fillable = [
        'userId',
        'website',
        'username',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
