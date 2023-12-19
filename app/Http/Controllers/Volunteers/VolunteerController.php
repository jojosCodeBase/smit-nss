<?php

namespace App\Http\Controllers\Volunteers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Volunteers\Volunteer;
use Illuminate\Database\QueryException;

class VolunteerController extends Controller
{
    public function manage()
    {
        return view('volunteers.manage');
    }
    public function add()
    {
        return view('volunteers.add');
    }
    public function search()
    {
        return view('volunteers.search');
    }
    public function view_edit()
    {
        return view('volunteers.view-edit');
    }
    public function list()
    {
        return view('volunteers.list');
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

    public function viewDetails(Request $r)
    {
        // dd($r->search_string);
        $volunteer = Volunteer::where('id', $r->search_string)
            ->orWhere('name', 'like', '%' . $r->search_string . '%')
            ->get();

        // var_dump($volunteer);

        if ($volunteer->isEmpty()) {
            return redirect()->route('volunteer.view-edit')->with('fail', 'No results found for '. $r->search_string);
        } else
            return view('volunteers.details', ['volunteer' => $volunteer])->with('success', 'success');
    }

    public function updateDetails(Request $r)
    {
        // $registrationNumber = $r->input('regno');
        // dd($registrationNumber);
        $updateVolunteer = Volunteer::where('id', $r->regno)->update([
            'name' => $r->name,
            'phone' => $r->phone,
            'email' => $r->email,
            'department' => $r->department,
            'course' => $r->course,
            'batch' => $r->batch,
        ]);

        if ($updateVolunteer)
            return back()->with('success', 'Volunteer details updated successfully !');
        else
            return back()->with('fail', 'Some error occured in updating volunteer details !');
        // dd('not updated');
        //     dd('updated');

    }

}
