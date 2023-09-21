<?php

namespace App\Http\Repository;

use App\Models\Hostel;

class HostelRepository
{

    public function getHostels(){
        try {
            $hostel = Hostel::orderBy('id','desc')->paginate(10);
            return response()->json($hostel);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 

    }
    public function storeHostel($request){
        try {
            $data =  $request->validated();  
            $data['created_by'] = auth()->user()->id;
            Hostel::insert($data);
            return response()->json(['message'=>"Hostel Created Cuccessfully","status"=>201]); 

        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function editHostel($id){
        try {
            $hostel = Hostel::find($id);
            return response()->json($hostel);
                                    
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
    }
    public function updateHostel($request,$id){
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->id;
            Hostel::find($id)->update($data);           
            return response()->json(['message'=>"Hostel Updated Cuccessfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }    
      
    }
    public function deleteHostel($id){
        try {
            Hostel::find($id)->delete();
            return response()->json(['message'=>"Hostel Deleted Cuccessfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
      
    }
}
