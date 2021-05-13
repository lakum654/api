<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Helpers\Helper;
use App\Helpers\Example;

class PmsController extends Controller
{
    public function index(Request $request){
    
        $attendance = Attendance::where('user_id',Auth::id())->whereDate('created_at', Carbon::today())->whereNotNull('out_time')->orderBy('updated_at','desc')->get();
        $checkOut = Attendance::where('user_id',Auth::id())->whereDate('created_at', Carbon::today())->where('status',0)->count();
        return view('attendance.index',compact('attendance','checkOut'));
    }

    //This Function call when In Entry
    public function in(Request $request)
    {
        $request->Session()->put('currentTime',date('h:i:s A'));
        Attendance::create(['user_id' => Auth::id(),'in_time' => date('h:i:s A'),'status' => 0,'date' => date('Y-m-d')]);
        $seconds = Attendance::where(['user_id' => Auth::id()])->whereDate('created_at', Carbon::today())->sum('session_hours');
        return back();
    }


    //This Function call when out Entry
    public function out(Request $request,$workingHours)
    {  

        
        Attendance::where(['user_id' => Auth::id()])->where('status',0)->update(['out_time' => date('h:i:s A'), 'status' => 1]);        
        
        $query = Attendance::where('user_id',Auth::id())->whereDate('date',Carbon::today())->orderBy('updated_at','desc');
        $lastUpdated = $query->first();
        $start = Carbon::parse($lastUpdated->in_time);
        $end = Carbon::parse($lastUpdated->out_time);
        //$minutes = $end->diffInMinutes($start);
        $seconds = $end->diffInSeconds($start);
        $query->update(['session_hours' => $seconds]);

        $todayWorkingHours = Attendance::where('user_id',Auth::id())->whereDate('date',Carbon::today())->sum('session_hours');
        $request->Session()->put('wholeTime',Helper::secondTo($todayWorkingHours));
        $request->Session()->forget('currentTime');   
        return back();

    }

    //This Function will call after in Entry
    public function startWork(Request $request,$seconds){
    //    $value = $request->Session()->get('workingHours');
    //    $value = $value + 5;
    //    Attendance::where(['user_id' => Auth::id()])->where('status',0)->update(['out_time' => date('h:i A'), 'status' => 0,'session_hours' => $value]);        
    //    $seconds = Attendance::where(['user_id' => Auth::id()])->whereDate('created_at', Carbon::today())->sum('session_hours');
    //    $hours = floor($seconds / 3600);
    //    $minutes = floor(($seconds / 60) % 60);
    //    $seconds = $seconds % 60;
    //    $workingDuration = "$hours:$minutes:$seconds";
    //    $request->Session()->put('wholeTime',$workingDuration);
    //    $request->Session()->put('workingHours',$value);
    //    return back();
    }

    public function report()
    {
       
        $report = Attendance::where('user_id',Auth::id())->get();
        return view('attendance.report',compact('report'));
    }

    public function getData(Request $request)
    {     
        $from = date('Y-m-d',strtotime($request->from));
        $to = date('Y-m-d',strtotime($request->to)); 
        $dates = array();
        $result = array();
        $current = strtotime($request->from);
        $date2 = strtotime($request->to);
        $stepVal = '+1 day';
        while( $current <= $date2 ) {
           $dates[] = date('Y-m-d', $current);
           $current = strtotime($stepVal, $current);
        }
       $result['date'] = $dates;
       
       $data = Attendance::query();
       if($from && $to)
       {
         $data->whereBetween(DB::raw('date'),[$from,$to]);
       }
       $data->get();
       $users = Attendance::whereBetween(DB::raw('date'),[$from,$to])->get()->unique('user_id');
       return view('attendance.ajax_response',compact('result','data','users'));
    }
}
