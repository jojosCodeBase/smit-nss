<?php

namespace App\Models\Drives;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'date',
        'from',
        'to',
        'conductedBy',
        'type',
        'area',
        'present',
        'absent',
        'description'
    ];
}
