<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // ADD teachers
    public function Add(Request $request)
    {
        
        $request->validate([
            'first_name'=>'required|string|max:191',
            'last_name'=>'required|string|max:191',
            'email'=>'required|min:10|unique:teachers,email',
            'cni'=>'required|min:3|string|unique:teachers',
            'filier'=>'required|string',
            'subject'=>'required|string',
            'roll_position'=>'string|nullable',
        ]);

        $teacher =new Teacher;

        $teacher->first_name =$request->first_name;
        $teacher->last_name =$request->last_name;
        $teacher->email =$request->email;
        $teacher->cni =$request->cni;
        $teacher->filier =$request->filier;
        $teacher->subject =$request->subject;
        $teacher->roll_position =$request->roll_position;
        $teacher->save();

        return response()->json(['message'=>'teacher Added Successfully'],200);

        
        
    }

    // View all teachers
    public function viewAll()
    {
        $teacher = Teacher::all();
        return response()->json(['message'=>$teacher],200);
    }

    //view one teacher by id
    public function viewOneTeach($id)
    {
        $teach = Teacher::find($id);
        if($teach):
            return response()->json(['message'=>$teach],200);
        else:
            return response()->json(['message'=>'this id is not available'],404);
        endif;

    }

    //update one teacher

    public function update(Request $request,$id)
    {
        

        $request->validate([
            'first_name'=>'required|string|max:191',
            'last_name'=>'required|string|max:191',
            'email'=>'required|min:10|unique:teachers,email',
            'cni'=>'required|min:3|string|unique:teachers',
            'filier'=>'required|string',
            'subject'=>'required|string',
            'roll_position'=>'string|nullable',
        ]);

        $teacher = Teacher::find($id);

        if($teacher):
            $teacher->first_name =$request->first_name;
            $teacher->last_name =$request->last_name;
            $teacher->email =$request->email;
            $teacher->cni =$request->cni;
            $teacher->filier =$request->filier;
            $teacher->subject =$request->subject;
            $teacher->roll_position =$request->roll_position;
            $teacher->update();

            return response()->json(['message'=>'teacher updated Successfully'],200);
        else:
            return response()->json(['message'=>'teacher not fund'],404);
        endif;

    }

    // delete one teacher
    
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if($teacher)
        {
            $teacher->delete();
            return response()->json(["message"=> "the teacher is deleted successfully"],200);
        }
        else
        {
            return response()->json(["message"=> "the teacher not fund"],404);
        }
    }
}