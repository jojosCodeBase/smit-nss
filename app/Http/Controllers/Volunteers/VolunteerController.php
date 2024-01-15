<?php

namespace App\Http\Controllers\Volunteers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Volunteers\Volunteer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Database\QueryException;

class VolunteerController extends Controller
{
    public function manage()
    {
        return view('admin.volunteers.manage');
        // return view('volunteers.manage');
        // // 'user' is not authenticated to manage volunteers
        // if($this->role == 2)
        // else
    }
    public function add()
    {
        // 'user' is authenticated to add volunteers
        if(Auth::user()->role == 2)
            return view('user.volunteers.add');
        else
            return view('admin.volunteers.add');
    }
    public function search()
    {
        // 'user' is authenticated to search volunteers
        if(Auth::user()->role == 2)
            return view('user.volunteers.search');
        else
            return view('admin.volunteers.search');

    }
    public function viewEdit()
    {
        // 'user' is not authenticated to edit volunteers
        // if($this->role == 0)
        //     return view('superadmin.volunteers.view-edit');
        // else
        //     return view('admin.volunteers.view-edit');

        $volunteers = Volunteer::paginate(10);

        return view('admin.volunteers.view-edit', compact('volunteers'));

    }
    public function list()
    {
        // // 'user' is not authenticated to edit volunteers
        // if($this->role == 0)
        //     return view('superadmin.volunteers.list');
        // else
        //     return view('admin.volunteers.list');
        return view('volunteers.list');

    }
    public function viewUpdate($regno)
    {
        // 'user' is not authenticated to update volunteers
        // if($this->role == 0){
            $volunteer = Volunteer::where('id', $regno)->get();
            return redirect()->route('volunteer.view-edit')->with(['volunteer' => $volunteer, 'success' => 'Volunteer details updated successfully !']);
        // }
    }

    public function insert(Request $r)
    {
        try {
            $volunteer = Volunteer::create([
                'id' => $r->regno,
                'name' => $r->name,
                'email' => $r->email,
                'phone' => $r->phone,
                'department' => $r->department,
                'course' => $r->course,
                'batch' => $r->batch,
            ]);

            if ($volunteer)
                return redirect()->route('volunteer.add')->withSuccess('success');
            else
                return redirect()->route('volunteer.add')->with('error', 'Some error occured while adding volunteer');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->route('volunteer.add')->with('error', 'Volunteer Already Exists');
            }
        }
    }

    public function searchDetails(Request $r)
    {
        // this returns an object
        $query = Volunteer::where('id', $r->search_string)
        ->orWhere('name', 'like', '%' . $r->search_string . '%');

        //converting the returned object to array
        $volunteers = $query->paginate(5);

        if ($volunteers->count() > 0) {
            if(Auth::user()->role == 1)
                return view('admin.volunteers.view-edit', compact('volunteers'));
            else
                return back()->with('volunteers', $volunteers);
        } else
            return back()->with('error', 'No results found for ' . $r->search_string);
    }

    public function updateDetails(Request $r)
    {
        $updateVolunteer = Volunteer::where('id', $r->regno)->update([
            'name' => $r->name,
            'phone' => $r->phone,
            'email' => $r->email,
            'course' => $r->course,
            'batch' => $r->batch,
        ]);

        if ($updateVolunteer) {
            return back()->with('success', 'Volunteers details updated successfully !');
        } else
            return back()->with('fail', 'Some error occured in updating volunteer details !');
    }

    public function fetchDetails(){
        $obj = Volunteer::all();

        $volunteers = $obj->toArray();

        if ($volunteers) {
            return back()->with('volunteers', $volunteers);
        } else{
            return back()->with('fail', 'No results found');
        }
    }

    public function getName($regno)
    {
        // dd("hello");
        $user = Volunteer::where('id', $regno)->first();
        // $user = $user->toArray();
        if($user)
            return response()->json(['name' => $user->name ]);
        else
            return response()->json(['name' => 'No results found']);
    }
    public function ajax(Request $upload){
        $user = Volunteer::where('id', $upload->title)->first();
        // $desc = $upload->description;
        if($user)
            return response()->json(['message' => $user->name ]);
        else
            return response()->json(['message' => 'No results found']);
    }
}
