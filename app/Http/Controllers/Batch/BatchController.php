<?php

namespace App\Http\Controllers\Batch;
use App\Models\Batch\Batch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{
    public function create(Request $r){
        $batch = Batch::create([
            'name' => $r->name,
            'studentCoordinator' => $r->studentCoordinator,
        ]);

        if($batch)
            return back()->with('success', 'Batch created successfully !');
        else
            return back()->with('error', 'Some error occured in creating new batch !');
    }

    public function createView(){
        return view('admin.batch.create');
    }

    public function viewEdit(){
        $batches = Batch::all();
        return view('admin.batch.view-edit', compact('batches'));
    }

    public function registrationForm($batchName){
        $batch = Batch::where('name', $batchName)->get();
        $status = $batch[0]['status'];
        return view('admin.batch.registration-form', compact('batchName', 'status'));
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
