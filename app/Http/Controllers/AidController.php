<?php

namespace App\Http\Controllers;

use App\Models\Aid;
use Illuminate\Http\Request;

class AidController extends Controller
{
    public function index()
    {
        $aid = Aid::all();
        return view('admin.listAllInventory') ->with('aid', $aid);
    }

   
    public function store(Request $request)
    {
        $input = $request->all();
        Aid::create($input);
        return redirect()->route('admin.listAllInventory')->with('success', 'Berjaya Ditambah!');
    
    }

  
    public function update(Request $request,$AidID)
    {
        $aid = aid::find($AidID);
        $input = $request->all();
        $aid->update($input);
        return redirect()->route('admin.listAllInventory')->with('success', 'Berjaya Dikemaskini!');
    }

    public function destroy(string $AidID)
    {
        aid::destroy($AidID);
        return redirect()->route('admin.listAllInventory')->with('success', 'Berjaya Dihapus!');
    }
}
