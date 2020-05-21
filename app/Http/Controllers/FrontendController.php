<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Session;
use Excel;
use Samples;
use App\Imports\ImportUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Frontend.appti_question');
    }
    
    public function getWelcome(){
        return view('Frontend.welcome');
    }
    
    public function getLast(){
        return view('Frontend.thank_you');
    }

    public function testSubmit(Request $request){
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        $user_id = Auth::user()->id;
        if(\App\Answer::where('stud_id', $user_id)->exists()){
            
        }else{
                $score = 0;
                $requestData['stud_id'] = $user_id;
                $requestData['date'] = date("Y-m-d");
                if(isset($requestData['qts'])){
                    $requestData['stud_ans'] = json_encode($requestData['qts']);
                }
                $last_inserted = \App\Answer::create($requestData);
                if(isset($requestData['qts'])){
                    foreach($requestData['qts'] as $key=>$val){
                        $questions = \App\Question::select('id','answer','marks')->where(['id'=>$key,'flag'=>0])->first();
        //                echo "<pre>";print_r($questions);//exit;
                        if($val == $questions->answer){
                            $score = $score + $questions->marks;
                        }
                    }
                }
            $id = $last_inserted->id;
            \App\Answer::where('id','=',$id)->update(['score'=>$score]);
            \App\User::where('id','=',$user_id)->update(['apti_flag'=>1]);
        }
        return redirect('thank_you');
    }
    
    public function updateProgramTest(Request $request){
        $requestData = $request->all();
        $user_id = Auth::user()->id;
        \App\User::where('id','=',$user_id)->update(['program_flag'=>1]);
		\App\Answer::where(['stud_id'=>$user_id])->update(['program_answer'=>$requestData['program_answer']]);
        return redirect('welcome');
    }

    public function getQuestions(){
        return view('Frontend.program_question');
    }
    
    public function updateUser(Request $request){
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        $collage_name = $requestData['collage_name'];
        $id = Auth::user()->id;
        \App\User::where('id','=',$id)->update(['collage_name'=>$collage_name]);
    }
 
}
