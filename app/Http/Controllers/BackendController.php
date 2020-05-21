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

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($this->role == 1){
            return view('Backend.quations');
        }else{
            return view('home');
        }
    }


    public function activeTest(){
        if($this->role == 1){
            $activation = \App\Activation::orderBy('id','desc')->first();
            return view('Backend.test_activation',['activation'=>$activation]);
        }else{
            return view('home');
        }
    }
	
	public function showAnswerpaper(){
        $id = $_GET['id'];
        $stud_answer = \App\Answer::where(['stud_id'=>$id])->first();
        return view('Backend.answer_paper',['stud_answer'=>$stud_answer]);
    }
    
	public function showProgrampaper(){
        $id = $_GET['id'];
        $stud_answer = \App\Answer::where(['stud_id'=>$id])->first();
        return view('Backend.answer_program',['stud_answer'=>$stud_answer]);
    }
	
	public function updateProgrampaper(Request $request){
		$requestData = $request->all();
		\App\Answer::where(['id'=>$requestData['id']])->update(['prog_marks'=>$requestData['prog_marks']]);
		return redirect('stud_mark');
		//echo "<pre>";print_r($requestData);exit;
	}
	
    public function saveActiveTest(Request $request){
        if($this->role == 1){
            $requestData = $request->all();
            \App\Activation::create($requestData);
            Session::flash('alert-success', 'Updated Successfully.');
            return redirect('activation_link');
        }else{
            return view('home');
        }
//        echo "<pre>";print_r($requestData);exit;
    }

    public function studList(){
        if($this->role == 1){
            $stud_list = \App\User::where(['role'=>2])->get();
    //        echo "<pre>";print_r($stud_list);exit;
            return view('Backend.stud_list',['stud_list'=>$stud_list]);
        }else{
            return view('home');
        }
    }
    
    public function editStud(){
        if($this->role == 1){
            $id = $_GET['id'];
            $stud_data = \App\User::where(['id'=>$id])->first();
            return view('auth.edit_stud',['stud_data'=>$stud_data]);
        }else{
            return view('home');
        }
    }
    
    public function getNote(){
        if($this->role == 1){
            $note = \App\Note::orderBy('id','desc')->first();
            return view('Backend.note',['note'=>$note]);
        }else{
            return view('home');
        }
    }

    public function saveNote(Request $request){
        if($this->role == 1){
            $requestData = $request->all();
            \App\Note::create($requestData);
            Session::flash('alert-success', 'Updated Successfully.');
            return redirect('note');
        }else{
            return view('home');
        }
    }

    public function getprogramNote(){
        if($this->role == 1){
            $note = \App\ProgramNote::orderBy('id','desc')->first();
            return view('Backend.program_note',['note'=>$note]);
        }else{
            return view('home');
        }
    }

    public function saveprogramNote(Request $request){
        if($this->role == 1){
            $requestData = $request->all();
            \App\ProgramNote::create($requestData);
            Session::flash('alert-success', 'Updated Successfully.');
            return redirect('program-note');
        }else{
            return view('home');
        }
    }
    
    public function updateStud(Request $request,$id){
        if($this->role == 1){
            $requestData = $request->except('password');
            if ($request->password)
                $requestData['password'] = bcrypt($request->password);
            $users = \App\User::findorfail($id);
            $users->update($requestData);
            Session::flash('alert-success', 'Updated Successfully.');
            return redirect('stud_list');
        }else{
            return view('home');
        }
    }
    
    public function marksDetail(){
        if($this->role == 1){
            $answer = DB::table('tbl_answer')
                ->select('tbl_answer.score','tbl_answer.prog_marks','tbl_answer.stud_id','users.name','users.email','users.mobile_no','users.collage_name')
                ->leftjoin('users','users.id','=','tbl_answer.stud_id')
                ->distinct()
                ->get();
            return view('Backend.stud_reprort',['answer'=>$answer]);
        }else{
            return view('home');
        }
    }
    
    public function reprotDetail(Request $request){
        if($this->role == 1){
            $requestData = $request->all();
    //        echo "<pre>";print_r($requestData);exit;
            $new_form_date = $new_to_date = "";
            $form_date = $requestData['from_date'];
            if(!empty($requestData['to_date']))
            {
                $to_date = $requestData['to_date']; 
            }
            else{
                $to_date = $requestData['from_date'];  
            }
            $date1 = strtr($form_date, '/', '-');
            $new_form_date = date("Y-m-d", strtotime($date1));
            $date2 = strtr($to_date,'/','-');
            $new_to_date = date("Y-m-d", strtotime($date2));
            $answer = DB::table('tbl_answer')
                ->select('tbl_answer.score','tbl_answer.stud_id','tbl_answer.date','users.name','users.email','users.mobile_no','users.collage_name')
                ->leftjoin('users','users.id','=','tbl_answer.stud_id')
                ->whereBetween('tbl_answer.date', array($new_form_date, $new_to_date))
                ->distinct()
                ->get();
    //        echo "<pre>";print_r($answer);exit;
            return view('Backend.student',['answer'=>$answer]);
        }else{
            return view('home');
        }
    }

    public function saveUpload(Request $request){
        if($this->role == 1){
        $requestData = $request->all();
        $this->validate($request, array(
            'sample_file'      => 'required'
        ));
        if($request->hasFile('sample_file')){
            $extension = File::extension($request->sample_file->getClientOriginalName());
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                    $array = Excel::toArray(new ImportUsers, $request->file('sample_file'));
                }
//                echo "<pre>";print_r($array);exit;
                $i = 0;
                date_default_timezone_set('Asia/Kolkata');
                $arr= array();
                if(count($array)>0){
//                    In Built Format
                    foreach ($array[0] as $key => $value) {
                        if($i > 0 && !empty($value[0])){
//                            if(!in_array($value[1], $arr)){
//                                $arr[] = $value[1];
                                $insert[] = [
                                'question' => $value[0],
                                'option1' => $value[1],
                                'option2' => $value[2],
                                'option3' => $value[3],
                                'option4' => $value[4],
                                'answer' => $value[5],
                                'marks' => $value[6],
                                ];
//                            }
                        }
                        $i++;
                    }
//                    echo "<pre>";print_r($insert);exit;
                    if(!empty($insert)){
                        $insertData = \App\Question::insert($insert);
                        if ($insertData) {
                            Session::flash('alert-success','Created Successfully.');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
        }
        Session::flash('alert-success', 'Updated Successfully.');
        return redirect('uplaod_quations');
        }else{
            return view('home');
        }
//        echo "<pre>";print_r($requestData);exit;
    }
    
    public function saveimgUpload(Request $request){
        if($this->role == 1){
        $requestData = $request->all();
        if(!empty($requestData['question'])){
            if(!empty($requestData['problem_fig'])) {
                $design = $requestData['problem_fig'];
                $filename = rand(0,999).$design->getClientOriginalName();
                $destination= "problem_fig";
                $design->move($destination,$filename);
                $requestData['problem_fig'] = $filename;
            }

            if(!empty($requestData['answer_fig'])) {
                $design = $requestData['answer_fig'];
                $filename = rand(0,999).$design->getClientOriginalName();
                $destination= "answer_fig";
                $design->move($destination,$filename);
                $requestData['answer_fig'] = $filename;
            }

    //        echo "<pre>";print_r($requestData);exit;
            \App\Question::create($requestData);
            Session::flash('alert-success', 'Updated Successfully.');
        }
            return redirect('uplaod_quations');
        
        }else{
            return view('home');
        }
//        echo "<pre>";print_r($requestData);exit;
    }
    
    //Programing Quetions
    public function getPquetions(){
        if($this->role == 1){
            return view('Backend.programing_quetions');
        }else{
            return view('home');
        }
    }
    
    public function savePquetions(Request $request){
        if($this->role == 1){
            $requestData = $request->all();
            if(!empty($requestData['questions'])){
                \App\Programing::create($requestData);
                Session::flash('alert-success', 'Saved Successfully.');
            }
            return redirect('progaming_quetions');
        }else{
            return view('home');
        }
    }
}
