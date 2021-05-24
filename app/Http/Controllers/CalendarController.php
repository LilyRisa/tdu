<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function list(){
        $Calendar = Calendar::all();
        return view('calendar',['calendar' => $Calendar]);
    }

    public function save(Request $request){
        $title = $request->input('title');
        $class_name = $request->input('class_name');
        $date = $request->input('date');
        $link = $request->input('link');
        $start = explode(" - ", $date)[0];
        $end = explode(" - ", $date)[1];
        if(strtotime($start) == strtotime($end)){
            $end = null;
        }
        $err = null;
        try{
            $calendar = new Calendar();
            $calendar->title = $title;
            $calendar->class_name = $class_name;
            $calendar->url = $link;
            $calendar->start = $start;
            $calendar->end = $end;
            $calendar->save();
        }
        catch(\Exception $e){
            $err = $e->getMessage();
        }
        return $err == null ? response()->json(['is' =>true]) : response()->json(['is' =>false, 'messenge' => $err]);
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $Calendar = Calendar::find($id);
        $Calendar->delete();
        return response()->json(['is' =>true]);
    }
}
