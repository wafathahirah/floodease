<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Position;
use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeComtroller extends Controller
{
   
    public function index()
    {
        $committee = Committee::with(['staff', 'position'])->get();
        $staff = Staff::distinct()->get(['SID', 'SName']);
       $position = Position::distinct()->get(['PosID', 'PosName']);

        return view('admin.listAllCommittee')->with('committee',$committee)->with('staff', $staff)->with('position', $position);
    }

    public function store(Request $request)
    {
        $request->validate([
            'SID' => 'required',
            'PosID' => 'required',
            'ComTask' => 'required',
            'ComLeader' => 'required',
            'ComDate' => 'required|date',
        ]);
        //$SID = Staff::where('SName', $request->input('SID'))->value('SID');
        
       // $PosID = Position::where('PosName', $request->input('PosID'))->value('PosID');
        
       Committee::create([
        'ComID' => $request->input('SID'),
        'SID' => $request->input('SID'),
        'PosID' => $request->input('PosID'),
        'ComTask' => $request->input('ComTask'),
        'ComLeader' => $request->input('ComLeader'),
        'ComDate' => $request->input('ComDate'),
        ]);

        return redirect()->route('admin.listAllCommittee')->with('success', 'Berjaya Ditambah!');
    }


    public function update(Request $request, $ComID)
    {
        
        $committee = Committee::find($ComID);
        $input = $request->all();
        $committee->update($input);
    

    return redirect()->route('admin.listAllCommittee')->with('success', 'Berjaya Dikemaskini!');
    }

    public function destroy($ComID)
    {
        Committee::destroy($ComID);
        return redirect()->route('admin.listAllCommittee')->with('success', 'Berjaya Dihapus!');
    }
}
