<?php

namespace App\Http\Controllers;

use App\Http\Requests\HostelRequest;
use App\Http\Repository\HostelRepository;
class HostelController extends Controller
{

    private $hostelRepository;

    public function __construct(HostelRepository $hostelRepository)
    {        
        $this->hostelRepository = $hostelRepository;
    }
   
    public function index()
    {
       return $this->hostelRepository->getHostels();   
        
    } 
  

    public function store(HostelRequest $request)
    {
        return $this->hostelRepository->storeHostel($request);        
      
    }   

    
    public function edit(string $id)
    { 
        return $this->hostelRepository->editHostel($id);     
      
    }

   
    public function update(HostelRequest $request, string $id)
    {
        return $this->hostelRepository->updateHostel($request,$id);      
       
    }

   
    public function destroy(string $id)
    {
        return $this->hostelRepository->deleteHostel($id); 
        
    }
}
