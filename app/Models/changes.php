<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class changes extends Model
{
    use HasFactory;

    protected $table = 'recentchanges';

    protected $fillable = [
        'userId',
        'action',
        'item'
    ];

    public static function createRecentChange($userId, $action, $item){
        return self::create([
            'userId' => $userId,
            'action' => $action,
            'item' => $item
        ]);
    }

}
