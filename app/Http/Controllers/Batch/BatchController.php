<?php

namespace App\Http\Controllers\Batch;
use App\Models\Batch\Batch;
use Illuminate\Http\Request;
use App\Models\Courses\Courses;
use App\Http\Controllers\Controller;
use App\Models\Volunteers\Volunteer;
use Illuminate\Database\QueryException;

class BatchController extends Controller
{
    public function create(Request $r){
        $r->validate([
            'name' => 'required|string|unique:batches,name|max:10',
            'studentCoordinator' => 'required|string|max:50'
        ],[
            'name,unique' => 'Batch already exists'
        ]);
        $batch = Batch::create([
            'name' => $r->name,
            'studentCoordinator' => $r->studentCoordinator,
        ]);

        if($batch)
            return back()->with('success', 'Batch created successfully !');
        else
            return back()->with('error', 'Some error occured in creating new batch !');
    }

    public function register(Request $r)
    {
        dd($r->all());
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

            if ($volunteer){
                //update volunteer in batch

                return redirect()->route('batch.registration-form', $r->batch)->withSuccess('success');
            }
            else
                return redirect()->route('batch.registration-form', $r->batch)->with('error', 'Some error occured while adding volunteer');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->route('batch.registration-form', $r->batch)->with('error', 'Volunteer Already Exists');
            }else{
                return $e->getMessage();
            }
        }
    }

    public function manage(){
        $batches = Batch::all();
        return view('admin.batch.manage', ['batches' => $batches]);
    }

    public function viewEdit(){
        $batches = Batch::all();
        foreach($batches as $b){
            Batch::where('name', $b['name'])->update([
                'volunteers' => Volunteer::where('batch', $b['name'])->count(),
            ]);
        }

        // reading batches after updation
        $batches = Batch::all();
        return view('admin.batch.view-edit', compact('batches'));
    }

    public function registrationForm($batchName){
        $batch = Batch::where('name', $batchName)->get();
        $status = $batch[0]['status'];
        $courses = Courses::all();
        return view('admin.batch.registration-form', compact('batchName', 'status', 'courses'));
    }

    public function updateStatus(Request $r){
        $batch = Batch::where('id', $r->id)->update([
            'status' => $r->status,
        ]);

        if($batch)
            return response()->json(['message' => 'success']);
        else
            return response()->json(['message' => 'failure']);
    }
}
