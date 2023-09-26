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
            return response()->json(['message'=>"Hostel Created Successfully","status"=>201]); 

        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function showHostel($id){
        try {
            if ($id == 0) {
                $resource = Hostel::get();        
                if (!$resource) {
                    return response()->json(['message' => 'Hostel not found'], 404);
                }        
                return response()->json($resource, 200);
            }        
            
            $resources = Hostel::find($id);        
            return response()->json($resources, 200);                          
                        
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
            return response()->json(['message'=>"Hostel Updated Successfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }    
      
    }
    public function deleteHostel($id){
        try {
            Hostel::find($id)->delete();
            return response()->json(['message'=>"Hostel Deleted Successfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
    }

   

}
