<?php

namespace App\Http\Controllers;

use App\Models\Aid;
use App\Models\Resident;
use App\Models\JKK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
   
    public function index()
    {
       
        $resident = Resident::all();
        $JKK = JKK::all();
        $aid = Aid::all();
        return view('admin.listAllResident')->with ('resident',$resident)->with('jkk',$JKK)->with('aid',$aid);
    }

//jkk
    public function ResidentJKK()
    {
        if(Auth::check()){
            $id=Auth::User()->id;
            $data['model']=Resident::where('user_id',$id)->get();
        }
        $JKK = JKK::all();
        $aid = Aid::all();
        return view('jkk/jkk_dashboard')->with ('resident',$data['model'])->with('JKK',$JKK)->with('aid',$aid);
 
    }
    public function store(Request $request)
    {
        $user=Auth::User();
        $request->validate([
            'ResID' => 'required|numeric',
            'ResDependencies' => 'required',
            'HouseCondition' => 'required',
            'ResName' => 'required',
            'ResStreet' => 'required',
            'ResPastAid' =>'required',
        ]);

        Resident::create([
            'ResID' => $request->input('ResID'),
            'ResDependencies' => $request->input('ResDependencies'),
            'HouseCondition' => $request->input('HouseCondition'),
            'ResName' => $request->input('ResName'),
            'ResCity' => $request->input('ResStreet'),
            'ResStreet' => $request->input('ResStreet'),
            'ResPastAid' => $request->input('ResPastAid'),
            'user_id' => $user->id,
        ]);
        return redirect()->route('jkk.dashboard')->with('success','Berjaya Ditambah !');
    }

    public function update(Request $request, $ResID)
    {
        $resident = Resident::find($ResID);
        $input = $request->all();
        $resident->update($input);
        return redirect()->route('jkk.dashboard')->with('success','Berjaya Dikemaskini!');    
    }


    public function destroy($ResID)
    {
        Resident::destroy($ResID);
        return redirect()->route('resident.index')->with('success','Berjaya Dihapus!');    
    }


    public function destroyJKK($ResID)
    {
        Resident::destroy($ResID);
        return redirect()->route('jkk.dashboard')->with('success','Berjaya Dihapus!');    
    }



    public function view($ResID)
    {
        $resident = Resident::find($ResID);
        return view('admin/listAllResident')->with('resident', $resident);
    }

    public function viewJKK($ResID)
    {
        $resident = Resident::find($ResID);
        return view('/jkk/jkk_dashboard')->with('resident', $resident);
    }
}
