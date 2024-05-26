<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Drive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class DriveController extends Controller
{
    function listAll()
    {
        $query = Drive::orderBy('id', 'desc')->get();
        $drives = $query->toArray();
        return view('admin.drives.manage', compact('drives'));
    }
    function addView()
    {
        $recentDrive = Drive::latest()->first();
        if ($recentDrive == null) {
            $id = 1;
        } else {
            $id = $recentDrive->id + 1;
        }

        // 'user' is authenticated to add drive
        if (Auth::user()->role == 2)
            return view('user.drives.add', compact('id'));
        else
            return view('admin.drives.add', compact('id'));
    }

    function searchDrive(Request $r)
    {
        $r->validate([
            'search_string' => 'required|string|max:50'
        ]);
        $query = Drive::where('title', 'like', '%' . $r->search_string . '%')->get();
        $drives = $query->toArray();

        if ($drives) {
            return view('admin.drives.manage', compact('drives'));
        } else {
            return back()->with('error', 'No records found for ' . $r->search_string);
        }
    }

    function showAttendance()
    {
        $drives = Drive::orderBy('id', 'desc')->get();
        $drives = $drives->toArray();

        // 'user' is authenticated to add drive attendance
        if (Auth::user()->role == 2)
            return view('user.drives.attendance', compact('drives'));
        else{
            $attend = Attendance::where('driveId', $drives[0]['id'])->get();
            $volunteerIds = array_column($attend->toArray(), 'regno');

            $volunteers = Volunteer::whereIn('id', $volunteerIds)->get();
            $volunteers = $volunteers->toArray();

            return view('admin.drives.attendance', compact('drives', 'volunteers'));
        }
    }

    function addAttendance()
    {
        $drive = Drive::whereDate('created_at', Carbon::today())->get();
        // dd($drive);
        $available = 0;
        if($drive){
            $available = 1;
            $attend = Attendance::where('driveId', $drive[0]['id'])->get();

            $volunteerIds = array_column($attend->toArray(), 'regno');

            $volunteers = Volunteer::whereIn('id', $volunteerIds)->get();

            $attend = $volunteers->toArray();

            return view('user.drives.attendance', compact('available', 'drive', 'attend'));
        }else{
            return view('user.drives.attendance', compact('available'));
        }
    }

    function addDrive(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'date' => 'required|date',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'conductedBy' => 'required|string|max:100',
            'driveType' => 'required|string|max:100',
            'area' => 'required|string|max:255',
            'description' => 'required|string|max:300',
        ]);
        // dd($request->all());
        $drive = Drive::create([
            'id' => $request->id,
            'title' => $request->title,
            'date' => $request->date,
            'from' => $request->from,
            'to' => $request->to,
            'conductedBy' => $request->conductedBy,
            'updatedBy' => Auth::user()->role,
            'type' => $request->driveType,
            'area' => $request->area,
            'description' => $request->description,
        ]);

        if ($drive) {
            return back()->with('success', 'Drive created successfully !');
        } else {
            return back()->with('error', 'Some error occured in creating drive !');
        }
    }

    function update(Request $r)
    {
        $r->validate([
            'id' => 'required|numeric|max:999999999999999999999',
            'date' => 'required|date',
            'from' => 'required|date_format:H:i:s',
            'to' => 'required|date_format:H:i:s',
            'title' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'conductedBy' => 'required|string|max:50',
            'driveType' => 'required|string|max:50',
            'present' => 'required|numeric|max:99999999',
            'description' => 'required|string|max:500',
        ],[
            'from.date_format' => 'Invalid date format at From',
            'to.date_format' => 'Invalid date format at To',
        ]);
        $drive = Drive::where('id', $r->id)->update([
            'title' => $r->title,
            'date' => $r->date,
            'from' => $r->from,
            'to' => $r->to,
            'conductedBy' => $r->conductedBy,
            'updatedBy' => Auth::user()->role,
            'type' => $r->driveType,
            'area' => $r->area,
            'present' => $r->present,
            'description' => $r->description,
        ]);

        if ($drive) {
            return back()->with('success', 'Drive details updated successfully !');
        } else {
            return back()->with('error', 'Some error occured in updating drive details !');
        }
    }

    function delete(Request $r)
    {
        $drive = Drive::where('id', $r->id)->delete();

        if ($drive) {
            return back()->with('success', 'Drive deleted successfully !');
        } else {
            return back()->with('error', 'Some error occured in deleting drive !');
        }
    }


    function getAttendees($driveId){
        $attend = Attendance::where('driveId', $driveId)->get(); // fetches all record which matched given driveId

        $volunteerIds = array_column($attend->toArray(), 'regno');

        $volunteers = Volunteer::whereIn('id', $volunteerIds)->get(); //  fetches records from table which matches the given regno's
        // dd($volunteers);
        return response()->json($volunteers);
    }

    function getDriveInfo($id){
        return response()->json(Drive::where('id', $id)->first());
    }

    public function viewDrive($id){
        $drive = Drive::where('id', $id)->first();
        $attendees = Attendance::with('volunteer.batches', 'volunteer.courses')->where('drive_id', $id)->get();
        // dd($attendees);
        return view('admin.drives.view', compact('drive', 'attendees'));
    }
}
