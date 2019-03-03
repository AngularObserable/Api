<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  
        return [
        'data' =>$this->collection->Transform(function($student){
               
               return [
                    
                    'id'=>$student->id,
                    'name'=>$student->name,
                     'email'=>$student->email,
                     'phone'=>$student->phone,
                   
               ];
        })
      ];
    }
}
