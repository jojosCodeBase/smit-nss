<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $fillable = [
        'regno',
        'drive_id'
    ];

    public function volunteer(){
        return $this->belongsTo(Volunteer::class, 'regno', 'regno');
    }
}
