<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Repository\RoomRepository;

class RoomController extends Controller
{

    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {        
        $this->roomRepository = $roomRepository;
    }
   
    public function index()
    {
       return $this->roomRepository->getRooms(); 
        
    } 
  

    public function store(RoomRequest $request)
    {
        return $this->roomRepository->storeRoom($request);        
      
    }   

    
    public function edit(string $id)
    { 
        return $this->roomRepository->editRoom($id);     
      
    }

   
    public function update(RoomRequest $request, string $id)
    {
        return $this->roomRepository->updateRoom($request,$id);      
       
    }

   
    public function destroy(string $id)
    {
        return $this->roomRepository->deleteRoom($id); 
        
    } 

  

}
