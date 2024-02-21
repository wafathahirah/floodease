<?php

namespace App\Http\Controllers;

use App\Models\JKK;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class JKKController extends Controller
{
    public function index()
    {
        $JKK = JKK::all();
        return view('admin.listAllJKK') ->with('JKK', $JKK);
        }
    public function store(Request $request)
    {
       $request->validate([
           'JKKID' => 'required|numeric',
           'JKKName' => 'required',
           'JKKPhoneNum' => 'required|numeric',
           'JKKEmail' => 'required|email',
           'VillageName' => 'required',

       ]);
 
        $user = User::create([
            'name' => $request->input('JKKName'),
            'email' => $request->input('JKKEmail'),
            'password' => Hash::make($request->input('JKKPhoneNum')),
            'role' => 'jkk',
            'userID' => $request->input('JKKID'),
        ]);
        JKK::create([
            
            'JKKID' => $request->input('JKKID'),
            'JKKName' => $request->input('JKKName'),
            'JKKPhoneNum' => $request->input('JKKPhoneNum'),
            'JKKEmail' => $request->input('JKKEmail'),
            'VillageName' => $request->input('VillageName'),
            'user_id' => $user->id,
        ]);
        event(new Registered($user));
        return redirect()->route('admin.listAllJKK')->with('success','Berjaya Ditambah !');
    }

    public function update(Request $request, $JKKID)
    {
        $user = User::where('userID', $JKKID)->first();
        if ($user) {
            $user->update([
                'name' => $request->input('JKKName'),
                'email' => $request->input('JKKEmail'),
            ]);
        }

        $JKK = JKK::find($JKKID);
        $JKK->update($request->all());
        return redirect()->route('admin.listAllJKK')->with('success','Berjaya Dikemaskini !');
    }
 
    

    public function destroy($JKKID)
    {
        JKK::destroy($JKKID);
        $user = User::where('userID', $JKKID)->first();
        if ($user) {
            $user->delete();        
        }
        return redirect()->route('admin.listAllJKK')->with('success','Berjaya Dihapus!');
    }
}
