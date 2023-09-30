<?php

namespace App\Http\Repository;
use App\Models\Rent;

class RentRepository
{

    public function getRents(){
        try {
            $Rent = Rent::with('hostel')->orderBy('id','desc')->paginate(2);
            return response()->json($Rent);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 

    }
    public function storeRent($request){
        try {
            $data =  $request->validated();  
            $data['created_by'] = auth()->user()->id;
            Rent::create($data);
            return response()->json(['message'=>"Rent Created Successfully","status"=>201]);
                       
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
   

    public function editRent($id){
        try {
            $Rent = Rent::find($id);
            return response()->json($Rent);
                                    
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
    }
    public function updateRent($request,$id){
        try {
            $data = $request->validated();
            $data['updated_by'] = auth()->user()->id;
            Rent::find($id)->update($data);
            return response()->json(['message'=>"Rent Updated Successfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }      
      
    }
    public function deleteRent($id){
        try {
            Rent::find($id)->delete();
            return response()->json(['message'=>"Rent Deleted Successfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
        
      
    }
}
