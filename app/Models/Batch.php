<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'studentCoordinator',
        'volunteers',
        'status',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'studentCoordinator');
    }
}
