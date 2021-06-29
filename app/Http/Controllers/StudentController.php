<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    // ADD Students
    public function Add(Request $request)
    {
        $request->validate([
            'first_name'=>'required|max:191',
            'last_name'=>'required|max:191',
            'email'=>'required|min:10|unique:students,email',
            'cne'=>'required|min:3|unique:students',
            'cni'=>'required|min:3|unique:students',
        ]);

        $student =new Student;

        $student->first_name =$request->first_name;
        $student->last_name =$request->last_name;
        $student->email =$request->email;
        $student->cne =$request->cne;
        $student->cni =$request->cni;
        $student->save();

        return response()->json(['message'=>'student Added Successfully'],200);

        
        
    }

    // View all Students
    public function viewAll()
    {
        $student = Student::all();
        return response()->json(['students'=>$student],200);
    }

    //view one student by id
    public function viewOneStud($id)
    {
        $stud = Student::find($id);
        if($stud):
            return response()->json(['student'=>$stud],200);
        else:
            return response()->json(['student'=>'this id is not available'],404);
        endif;

    }

    //update one student

    public function update(Request $request,$id)
    {
        

        $request->validate([
            'first_name'=>'required|max:191',
            'last_name'=>'required|max:191',
            'email'=>'required|min:10',
            'cne'=>'required|min:3',
            'cni'=>'required|min:3',
        ]);

        $student = Student::find($id);

        if($student):
            $student->first_name =$request->first_name;
            $student->last_name =$request->last_name;
            $student->email =$request->email;
            $student->cne =$request->cne;
            $student->cni =$request->cni;
            $student->update();

            return response()->json(['message'=>'student updated Successfully'],200);
        else:
            return response()->json(['message'=>'student not fund'],404);
        endif;

    }

    // delete one student
    
    public function destroy($id)
    {
        $student = Student::find($id);

        if($student)
        {
            $student->delete();
            return response()->json(["student"=> "the student is deleted successfully"],200);
        }
        else
        {
            return response()->json(["student"=> "the student not fund"],404);
        }
    }
}