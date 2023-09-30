<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentRequest;
use App\Http\Repository\RentRepository;

class RentController extends Controller
{

    private $RentRepository;

    public function __construct(RentRepository $RentRepository)
    {        
        $this->RentRepository = $RentRepository;
    }
   
    public function index()
    {
       return $this->RentRepository->getRents(); 
        
    } 
  

    public function store(RentRequest $request)
    {
        return $this->RentRepository->storeRent($request);        
      
    }   

    
    public function edit(string $id)
    { 
        return $this->RentRepository->editRent($id);     
      
    }

   
    public function update(RentRequest $request, string $id)
    {
        return $this->RentRepository->updateRent($request,$id);      
       
    }

   
    public function destroy(string $id)
    {
        return $this->RentRepository->deleteRent($id); 
        
    } 

  

}
