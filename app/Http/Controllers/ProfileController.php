<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JKK;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function show()
     {
        $staff = Staff::all();
        $JKK = JKK::all();
         $user = Auth::user();
         return view('profile.show', compact('user', 'staff', 'JKK'));

     }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function Staffedit(Request $request)
    {
    
        $user = Auth::user();
        $staff = $user->staff ?? new Staff();
    
        return view('staff.profile', compact('user', 'staff'));
    }

   

public function JKKEdit(Request $request): View
{
    $user = Auth::user();
    $JKK = $user->JKK ?? new JKK();

    return view('jkk.profile', compact('user', 'JKK'));
}



    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function StaffUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate the request
        $request ->validate([
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
    
        return redirect()->route('profile.Staffedit')->with('success', 'Berjaya Kemaskini !');
    }
    
    public function JKKUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate the request
        $request ->validate([
            'JKKPhoneNum' => 'required|numeric',
            'VillageName' => 'required',
            'JKKEmail' => 'required|email',
        ]);
       
        // Update the User record
        $user = $request->user();
        $user->update([
            'email' => $request->input('JKKEmail'),
        ]);
    
        // Update the Staff record
        $JKK = $user->JKK ?? new JKK();
        if ($JKK) {
            $JKK->update([
                'JKKPhoneNum' => $request->input('JKKPhoneNum'),
                'VillageName' => $request->input('VillageName'),
                'JKKEmail' => $request->input('JKKEmail'),
            ]);
        }
    
        return redirect()->route('profile.JKKEdit')->with('success', 'Berjaya Kemaskini !');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
