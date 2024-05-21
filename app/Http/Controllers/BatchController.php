<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Database\QueryException;

class BatchController extends Controller
{
    public function create(Request $r)
    {
        $r->validate([
            'name' => ['required', 'string', 'unique:batches,name', 'max:10', 'regex:/^[0-9\-]+$/'],
            'studentCoordinator' => 'required|string|max:50'
        ], [
            'name.required' => 'The batch name field is required.',
            'name.string' => 'The batch name field must be a string.',
            'name.unique' => 'Batch already exists.',
            'name.max' => 'The batch name field must not be greater than 10 characters.',
            'name.regex' => 'The batch name field must contain only numbers and hyphens.',
            'studentCoordinator.required' => 'The student coordinator field is required.',
            'studentCoordinator.string' => 'The student coordinator field must be a string.',
            'studentCoordinator.max' => 'The student coordinator field must not be greater than 50 characters.'
        ]);

        $batch = Batch::create([
            'name' => $r->name,
            'studentCoordinator' => $r->studentCoordinator,
        ]);

        if ($batch)
            return back()->with('success', 'Batch created successfully !');
        else
            return back()->with('error', 'Some error occured in creating new batch !');
    }

    public function register(Request $r)
    {
        $validatedData = $r->validate([
            'name' => 'required|string',
            'regno' => ['required','numeric','unique:volunteers,id'],
            'email' => ['required','email','unique:volunteers,email'],
            'gender' => 'required|in:M,F,O',
            'phone' => 'required|numeric',
            'dob' => 'required|date',
            'course' => 'required|string',
            'category' => 'required|string',
            'nationality' => 'required|string',
            'batch' => 'required|numeric',
            'document' => ['required','numeric','unique:volunteers,document_number'],
            [
                'regno.unique' => 'The registration number already exist.',
                'email.unique' => 'The email already exist.',
                'gender.in' => 'The gender must be one of: Male (M), Female (F), or Others (O).',
                'document.unique' => 'The document number already exist.'
            ]
        ]);
        // dd($r->all());

        try {
            $volunteer = Volunteer::create([
                'id' => $r->regno,
                'name' => $r->name,
                'email' => $r->email,
                'phone' => $r->phone,
                'gender' => $r->gender,
                'date_of_birth' => $r->dob,
                'category' => $r->category,
                'nationality' => $r->nationality,
                'document_number' => $r->document_number,
                'course' => $r->course,
                'batch' => $r->batch,
            ]);

            if ($volunteer) {
                //update volunteer in batch
                // return redirect()->route('batch.registration-form', $r->batch)->withSuccess('success');
                return back()->withSuccess('success');
            } else
                return redirect()->route('batch.registration-form', $r->batch)->with('error', 'Some error occured while adding volunteer');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Volunteer Already Exists');
            } else {
                return $e->getMessage();
                // return back()->with('error', 'Some error occured while adding volunteer');
            }
        }
    }

    public function manage()
    {
        $batches = Batch::orderBy('created_at', 'desc')->get();
        return view('admin.batch.manage', ['batches' => $batches]);
    }

    public function viewEdit()
    {
        $batches = Batch::all();
        foreach ($batches as $b) {
            Batch::where('name', $b['name'])->update([
                'volunteers' => Volunteer::where('batch', $b['name'])->count(),
            ]);
        }

        // reading batches after updation
        $batches = Batch::all();
        return view('admin.batch.view-edit', compact('batches'));
    }

    public function registrationForm($batchName)
    {
        $batch = Batch::where('name', $batchName)->first();
        $status = $batch['status'];
        $batchId = $batch['id'];
        $courses = Courses::all();
        return view('admin.batch.registration-form', compact('batchName', 'status', 'courses', 'batchId'));
    }

    public function updateStatus(Request $r)
    {
        $batch = Batch::where('id', $r->id)->update([
            'status' => $r->status,
        ]);

        if ($batch)
            return response()->json(['message' => 'success']);
        else
            return response()->json(['message' => 'failure']);
    }

    public function getBatchInfo($id)
    {
        return response()->json(Batch::where('id', $id)->first());
    }
    public function updateBatchInfo(Request $r)
    {
        $r->validate([
            'batchName' => ['required', 'max:10', 'regex:/^[0-9\-]+$/'],
            'studentCoordinator' => 'required|string|max:50'
        ], [
            'name.required' => 'The batch name field is required.',
            'name.string' => 'The batch name field must be a string.',
            'name.max' => 'The batch name field must not be greater than 10 characters.',
            'name.regex' => 'The batch name field must contain only numbers and hyphens.',
            'studentCoordinator.required' => 'The student coordinator field is required.',
            'studentCoordinator.string' => 'The student coordinator field must be a string.',
            'studentCoordinator.max' => 'The student coordinator field must not be greater than 50 characters.'
        ]);

        $batch = Batch::where('id', $r->id)->update([
            'name' => $r->batchName,
            'studentCoordinator' => $r->studentCoordinator,
        ]);

        if ($batch)
            return back()->with('success', 'Batch details updated successfully !');
        else
            return back()->with('error', 'Some error occured in updating batch details !');
    }
}