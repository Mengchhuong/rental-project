<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Models\Rent;

class RoomController extends Controller
{
    //
    public function createRoom(Request $request){
        // $files =fopen($request->file('files'),'r') ;
        // foreach($files as $file){
        //     // here is your file object
        //     error_log($file->getClientOriginalName());
        // }
        $pictures =[];

        if($request->file('files')!=null){

            // for each ($request->file('files') as $file){
            //     $filename ='/images/'.file->getClientOriginalName();
            //     $file->move(public_path('images'),$filename);
            //     $pictures[] = $filename;
            // }
            foreach ($request->file('files') as $file){
                $filename = '/images/'.$file->getClientOriginalName();
                $file->move(public_path('images'),$filename);
                $pictures[] = $filename;
                // error_log($filename);
            }

        }
        return Room::create([
            'roomname' =>$request->roomname,
            'status' =>$request->status,
            'price' =>$request->price,
            'detail' =>$request->detail,
            'images' => json_encode($pictures),
        ]);
     }
    public function listRoom(){
        return Room::all();
    }
    public function deleteRoom($id){
        $room = Room::find($id);
        $room->delete();
        return response()->json($room);
    }
    public function updateRoom(Request $request,$id){

        // return $request->all();
        $rentId= DB::table('rents')
        ->join('rooms','rooms.id','=','rents.room_id')
        ->where('room_id','=',$id)
        ->get();

        // return $rentId[0]->room_id;
        // return $request->all();
        $room=Room::find($id);
        $room->update([
            'roomname'=>$request->roomname,
            'price'=>$request->price,
            'detail'=>$request->detail
        ]);
        // return $rent;
        // $room = Room::find($id);
        $rent=Rent::find($rentId[0]->room_id);
        $rent->update([
            'cusname'=>$request->cusname,
            'cusphone'=>$request->cusphone,
            'rentdate'=>$request->rentdate,

        ]);
        $res['room']=$room;
        $res['rent']=$rent;
        return response()->json($res);
    }
    // public function setCustomer(Request $request,)
}
