<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $fillable = [
        'regno',
        'name',
        'gender',
        'date_of_birth',
        'category',
        'nationality',
        'phone',
        'email',
        'department',
        'course',
        'batch',
        'drives_participated',
        'document_number',
    ];

    public function batches(){
        return $this->belongsTo(Batch::class, 'batch');
    }
    public function courses(){
        return $this->belongsTo(Courses::class, 'course');
    }
}
