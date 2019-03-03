<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\model\student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Student::latest()->paginate(10);
         //return new StudentResource(Student::find(1));
         return new StudentCollection(Student::latest()->paginate(10));
         //return Student::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validation =  Validator::make($request->all(),[
        //    'name'=>'required',
        //    'email'=>'required|email|uniqid',
        //    'phone'=>'required|numeric',
        // ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return new StudentResource($student);



    }

    public function search($field,$query){
          
          return new StudentCollection(Student::where($field,'LIKE',"%$query%")->latest()->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StudentResource(Student::findOrfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:students,email,'.$id,
            'phone' => 'required|numeric',
        ]);

        $student = Student::findOrfail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student =Student::findOrfail($id);
         $student->delete();

         return new StudentResource($student);

    }
}
