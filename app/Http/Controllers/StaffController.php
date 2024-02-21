<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('staff.staff_dashboard')->with('staff', $staff);
    }

    public function listAllStaff()
    {
        $staff = Staff::all();
        return view('admin.listAllStaff')->with('staff', $staff);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'SID' => 'required|numeric',
            'SName' => 'required',
            'SPhoneNum' => 'required|numeric',
            'SAddress' => 'required',
            'SEmail' => 'required|email',
            'SRole' => 'required',

        ]);
        $user = User::create([
            'name' => $request->input('SName'),
            'email' => $request->input('SEmail'),
            'password' => Hash::make($request->input('SPhoneNum')),
            'role' => $request->input('SRole'),
            'userID' => $request->input('SID'),
        ]);

        Staff::create([
            'SID' => $request->input('SID'),
            'SName' => $request->input('SName'),
            'SPhoneNum' => $request->input('SPhoneNum'),
            'SAddress' => $request->input('SAddress'),
            'SEmail' => $request->input('SEmail'),
            'SPwd' =>Hash::make($request->input('SPhoneNum')),
            'SRole' => $request->input('SRole'),
            'user_id' => $user->id,


        ]);
        event(new Registered($user));

        return redirect('/admin/listAllStaff')->with('success', 'Kakitangan Berjaya Didaftar !');
    }

    
    public function update(Request $request, $SID)
    {
            $user = User::where('userID', $SID)->first();
            if ($user) {
                $user->update([
                    'name' => $request->input('SName'),
                    'email' => $request->input('SEmail'),
                    'role' => $request->input('SRole'),
                ]);
            }
    
            $staff = Staff::find($SID);
            $input = $request->all();
            $staff->update($input);
        
    
        return redirect('/admin/listAllStaff')->with('success', 'Kakitangan Berjaya Dikemaskini !');
    }

    public function destroy($SID)
    {
        
        Staff::destroy($SID);
        $user = User::where('userID', $SID)->first();
        if ($user) {
            $user->delete();        
        }

        return redirect('/admin/listAllStaff')->with('success', 'Kakitangan Berjaya Dihapus !');

    }
}
