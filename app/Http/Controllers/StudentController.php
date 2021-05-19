<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Examinfo;
use App\Models\Question;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('exam.student_create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $student= new Student();

        $sIdForValidate=$request->input('student_id');
        $examCodeForValidate=$request->input('exam_code');
        $initialScore=0;

        $checker = Student::where('student_id','=',$sIdForValidate)->where('uniqueid','=',$examCodeForValidate)->count();
        if ($checker>0) {
            return "BẠN ĐÃ LÀM BÀI THI NÀY";
        }else{
            $student = Student::create([
            'student_id' => $request->input('student_id'),
            'uniqueid' => $request->input('exam_code'),
            'score' =>$initialScore
            ]);

            $id=$request->input('exam_code');
            $studentRealId=$request->input('student_id');
            $student_id=Student::where('student_id',$studentRealId)->value('id');
            $findcourse= Examinfo::where('uniqueid',$id)->value('id');
            $findtime= Examinfo::where('uniqueid',$id)->value('time');
            $course= Examinfo::where('uniqueid',$id)->value('Course');
            $questions=Question::where('quiz_id',$findcourse)->get();
            return view('exam.answer_show')->with('questions', $questions)->with('student_id',$student_id)->with('course',$course)->with('time',$findtime);
        }
        

        //return $this->show($request->input('exam_code'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}