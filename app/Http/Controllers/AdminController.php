<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Aid;
use App\Models\Committee;
use App\Models\JKK;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $residentCounts = Resident::select('ResID')->groupBy('ResID')->get()->count();
        $jkkc = JKK::select('JKKID')->groupBy('JKKID')->get()->count();
        $aidc = Aid::select('AidID')->groupBy('AidID')->get()->count();
        $comc = Committee::select('ComID')->groupBy('ComID')->get()->count();
        return view('admin.admin_dashboard', compact('residentCounts', 'jkkc', 'aidc', 'comc'));
    }

    //////////////////profile

    public function Adminedit(Request $request)
    {

        $user = Auth::user();
        $staff = $user->staff ?? new Staff();

        return view('admin.profile', compact('user', 'staff'));
    }

    public function AdminUpdate(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'SPhoneNum' => 'required|numeric',
            'SAddress' => 'required',
            'SEmail' => 'required|email',
        ]);

        // Update the User record
        $user = $request->user();
        $user->update([
            'email' => $request->input('SEmail'),
        ]);

        // Update the Staff record
        $staff = $user->staff ?? new Staff();
        if ($staff) {
            $staff->update([
                'SPhoneNum' => $request->input('SPhoneNum'),
                'SAddress' => $request->input('SAddress'),
                'SEmail' => $request->input('SEmail'),
            ]);
        }

        return redirect()->route('profile.Adminedit')->with('success', 'berjaya kemaskini');
    }
}
