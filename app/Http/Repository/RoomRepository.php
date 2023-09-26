<?php

namespace App\Http\Repository;
use App\Models\Room;

class RoomRepository
{

    public function getRooms(){
        try {
            $room = Room::with('hostel')->orderBy('id','desc')->paginate(2);
            return response()->json($room);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 

    }
    public function storeRoom($request){
        try {
            $data =  $request->validated();  
            $data['created_by'] = auth()->user()->id;
            Room::insert($data);
            return response()->json(['message'=>"Room Created Successfully","status"=>201]);
                       
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function editRoom($id){
        try {
            $room = Room::find($id);
            return response()->json($room);
                                    
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
    }
    public function updateRoom($request,$id){
        try {
            $data = $request->validated();
            $data['updated_by'] = auth()->user()->id;
            Room::find($id)->update($data);
            return response()->json(['message'=>"Room Updated Successfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }      
      
    }
    public function deleteRoom($id){
        try {
            Room::find($id)->delete();
            return response()->json(['message'=>"Room Deleted Successfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
        
      
    }
}
