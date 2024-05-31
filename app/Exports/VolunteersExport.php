<?php

namespace App\Exports;

use App\Models\Volunteer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VolunteersExport implements FromCollection, WithHeadings
{
    protected $batch;
    protected $course;

    public function __construct($batch, $course)
    {
        $this->batch = $batch;
        $this->course = $course;
    }

    public function collection()
    {
        $query = Volunteer::join('batches', 'volunteers.batch', '=', 'batches.id')
            ->join('courses', 'volunteers.course', '=', 'courses.id')
            ->select(
                'volunteers.regno',
                'volunteers.name',
                'volunteers.email',
                'volunteers.phone',
                'batches.name as batch_name',
                'courses.name as course_name',
                'drives_participated',
                'gender',
                'date_of_birth',
                'category',
                'nationality',
                'document_number',
            );

        if ($this->batch != '*') {
            $query->where('volunteers.batch', $this->batch);
        }

        if ($this->course != '*') {
            $query->where('volunteers.course', $this->course);
        }

        return $query->get(['regno', 'name', 'email', 'phone', 'batch', 'course', 'drives_participated', 'gender', 'date_of_birth', 'category', 'nationality', 'document_number']);
    }

    public function headings(): array
    {
        return [
            'Reg No',
            'Name',
            'Email',
            'Phone',
            'NSS Batch',
            'Course',
            'Drives Participated',
            'Gender',
            'Date of birth',
            'Category',
            'Nationality',
            'Document number'
        ];
    }
}

