<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
class RentController extends Controller
{
    //
    public function index(Request $request){
        $res=DB::table('rooms as r')
        ->join('rents','rents.room_id','=','r.id')
        ->get();
        return $res;
    }
    public function store(Request $request,$id){
        return Rent::create([
            'room_id'=>(int)$id,
            'cusname' =>$request->cusname,
            'cusemail' =>$request->cusemail,
            'telephone' =>$request->telephone,
            'rentdate' =>date("Y-m-d"),
        ]);
    }

    // public function getData(Request $request){
    //     return Rent::all();
    // }
    // public function edit(Request $request,$id){
    //     $rent=Rent::where('roomname',$id)->with('rooms')->get();
    //     return $rent->update($request->all());
    // }
    public function edit(Request $request,$id){
        $rent=Rent::where('roomname',$id)->with('rooms')->get();
        return $rent->update($request->all());
    }
    public function destroy($id){
        return Rent::where('roomname',$id)->delete();
    }
}
