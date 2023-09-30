<?php

namespace App\Http\Repository;
use App\Models\Seat;

class SeatRepository
{

    public function getSeats(){
        try {
            $Seat = Seat::with('hostel','room')->orderBy('id','desc')->paginate(2);
            return response()->json($Seat);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 

    }
    public function storeSeat($request){
        try {
            $data =  $request->validated();  
            $data['created_by'] = auth()->user()->id;
            Seat::insert($data);
            return response()->json(['message'=>"Seat Created Successfully","status"=>201]);
                       
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function editSeat($id){
        try {
            $Seat = Seat::find($id);
            return response()->json($Seat);
                                    
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
    }
    public function updateSeat($request,$id){
        try {
            $data = $request->validated();
            $data['updated_by'] = auth()->user()->id;
            Seat::find($id)->update($data);
            return response()->json(['message'=>"Seat Updated Successfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }      
      
    }
    public function deleteSeat($id){
        try {
            Seat::find($id)->delete();
            return response()->json(['message'=>"Seat Deleted Successfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
        
      
    }
}
