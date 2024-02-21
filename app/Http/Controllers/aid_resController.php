<?php

namespace App\Http\Controllers;

use App\Models\aid;

use App\Models\User;
use App\Models\Staff;
use App\Models\aid_res;
use App\Models\Resident;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Notifications\aidRes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class aid_resController extends Controller
{
    public function index()
    {
    
        $committee = Committee::distinct()->get(['SID', 'ComID']);
        $resident = Resident::distinct()->get(['ResID', 'ResStreet']);
        $aid = aid::distinct()->get(['AidID', 'AidType']);
        $staff = Staff::distinct()->get(['SID', 'SName']);
        $aid_res = aid_res::with(['committee', 'aid', 'resident'])->get();
        return view('admin.listAllLeaderLocation')->with('aid_res', $aid_res)->with('committee', $committee)->with('resident', $resident)->with('aid', $aid)->with('staff', $staff);
    }

    public function staffList()
    {
        $committee = Committee::distinct()->get(['SID', 'ComID']);
        $resident = Resident::distinct()->get(['ResID', 'ResStreet']);
        $aid = aid::distinct()->get(['AidID', 'AidType']);
        $staff = Staff::distinct()->get(['SID', 'SName']);
        $aid_res = aid_res::with(['committee', 'aid', 'resident'])->get();
        return view('staff.staff_dashboard')->with('aid_res', $aid_res)->with('committee', $committee)->with('resident', $resident)->with('aid', $aid)->with('staff', $staff);
    }


    public function store(Request $request)
    {
        $user = Auth::User();
        $request->validate([
            'ComID' => 'required',
            'ResID' => 'required',
            'AidID' => 'required',    //pilihpackage
            'aid_resStatus' => 'required',
            'aid_resQuantity' => 'required | numeric',
        ]);
        $data_aid_res=[
            'ComID' => $request->input('ComID'),
            'ResID' => $request->input('ResID'),
            'AidID' => $request->input('AidID'),
            'aid_resStatus' => $request->input('aid_resStatus'),
            'aid_resQuantity' => $request->input('aid_resQuantity'),
            'user_id' => $user->id,

        ];
        $aid_res = aid_res::create($data_aid_res);
        $staff = User::where('role', 'staff')->get();
        $userAdmin = User::where('role', 'admin')->get();
        Notification::send($userAdmin, new aidRes($aid_res));
        Notification::send($staff, new aidRes($aid_res));
        return redirect()->route('admin.listAllLeaderLocation')->with('success','Berjaya ditambah !');

    }
    public function Staffstore(Request $request)
    {
        $request->validate([
            'ComID' => 'required',
            'ResID' => 'required',
            'AidID' => 'required',    //pilihpackage
            'aid_resStatus' => 'required',
            'aid_resQuantity' => 'required | numeric',
        ]);
       $data=[
            'ComID' => $request->input('ComID'),
            'ResID' => $request->input('ResID'),
            'AidID' => $request->input('AidID'),
            'aid_resStatus' => $request->input('aid_resStatus'),
            'aid_resQuantity' => $request->input('aid_resQuantity'),

        ];
       $aidRes = aid_res::create($data);
       $com = User::where('role', 'staff')->get();
       $admin = User::where('role', 'admin')->get();
       Notification::send($admin, new aidRes($aidRes));
       Notification::send($com, new aidRes($aidRes));

        return redirect()->route('staff.dashboard')->with('success','Berjaya Ditambah !');
    }

  



    public function deleteAll()
    {
        aid_res::truncate(); // Delete all records in the model's table

        return redirect()->route('admin.listAllLeaderLocation')->with('success','Berjaya Hapus Semua !');
    }
}
