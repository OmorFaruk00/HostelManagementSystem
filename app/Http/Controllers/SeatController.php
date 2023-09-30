<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatRequest;
use App\Http\Repository\SeatRepository;

class SeatController extends Controller
{

    private $SeatRepository;

    public function __construct(SeatRepository $SeatRepository)
    {        
        $this->SeatRepository = $SeatRepository;
    }
   
    public function index()
    {
       return $this->SeatRepository->getSeats(); 
        
    } 
  

    public function store(SeatRequest $request)
    {
        return $this->SeatRepository->storeSeat($request);        
      
    }   

  

    
    public function edit(string $id)
    { 
        return $this->SeatRepository->editSeat($id);     
      
    }

   
    public function update(SeatRequest $request, string $id)
    {
        return $this->SeatRepository->updateSeat($request,$id);      
       
    }

   
    public function destroy(string $id)
    {
        return $this->SeatRepository->deleteSeat($id); 
        
    }
}
