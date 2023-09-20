<?php

namespace App\Http\Controllers;

use App\Http\Requests\HostelRequest;
use App\Models\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
   
    public function index()
    {
        try {
         $hostel = Hostel::orderBy('id','desc')->paginate(10);
         return response()->json($hostel);
                     
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
        
        
    }

  
    public function create()
    {
        //
    }

    public function store(HostelRequest $request)
    {
        try {
            $data =  $request->validated();  
            $data['created_by'] = auth()->user()->id;
            Hostel::insert($data);
            return response()->json(['message'=>"Hostel Created Cuccessfully","status"=>201]);           
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
      
    }

   
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        try {
            $hostel = Hostel::find($id);
            return response()->json($hostel);
                                    
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
    }

   
    public function update(HostelRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->id;
            $hostel = Hostel::find($id);
            $hostel->update($data);
            return response()->json(['message'=>"Hostel Updated Cuccessfully","status"=>200]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           }       
     
       
    }

   
    public function destroy(string $id)
    {

        try {
            Hostel::find($id)->delete();
            return response()->json(['message'=>"Hostel Deleted Cuccessfully"]);
                        
           } catch (\Exception $e) {
               return $e->getMessage();
           } 
        
    }
}
