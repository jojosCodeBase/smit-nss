<?php

namespace App\Models\Volunteers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'department',
        'course',
        'batch',
        'drives_participated',
        'absent',
    ];
}
