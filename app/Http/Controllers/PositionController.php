<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    public function index()
    {
        $position = Position::all();
        return view('admin.listAllPosition')->with('position',$position);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'PosName' => 'required',
            'PosDesc' => 'required',
        ]);

        Position::create([
            'PosName' => $request->input('PosName'),
            'PosDesc' => $request->input('PosDesc'),
        ]);

        return redirect()->route('admin.listAllPosition')->with('success', 'Berjaya Ditambah!');

    }

   
    public function update(Request $request, $PosID)
    {
        $position = Position::find($PosID);
            $input = $request->all();
            $position->update($input);
        
    
        return redirect()->route('admin.listAllPosition')->with('success', 'Berjaya Dikemaskini!');
    }

  
    public function destroy($PosID)
    {
        Position::destroy($PosID);
        return redirect()->route('admin.listAllPosition')->with('success', 'Berjaya Dihapus!');

    }
}
