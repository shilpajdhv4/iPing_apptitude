@extends('layouts.app')
@section('title', 'Register Students')
@section('content')
<?php
$answer = json_decode($stud_answer->stud_ans,true);
$info = \App\User::select('name')->where(['id'=>$stud_answer->stud_id])->first();
//echo "<pre>";print_r($answer);exit;
$x = 1; ?>
<main class="app-content" >
    <div class="app-title" style="position: fixed;z-index: 1;width: 93%;">
        <div>
            <h1> Answer Paper </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <h1>
                <div id="startValuesAndTargetExample">
                    <div class="values"></div>
                </div>
                </h1>
            </li>
        </ul>
    </div>
    <div class="row" style="margin-top: 60px;">
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group row">
                    <div class="col-md-12" style="color:black">
                        <p style="white-space: pre-line;"><b>Student Name : {{$info->name}}</b><p>
                        <p style="white-space: pre-line;"><b>Total Score : {{$stud_answer->score}}</b><p>
                    <hr>
                    </div>
                </div>
                <?php foreach($answer as $key=>$val){ 
                 $q = \App\Question::select('question','answer')->where(['id'=>$key])->first();    
                ?>
                <label class="control-label" style="white-space: pre-line;"><b>Ques {{$x++}} :</b> {{$q->question}}</label>
                <div class="form-group row">
                    <div class="col-md-8">
                      <b>Answer :</b> {{$val}} 
                      <br/>
                      <b>Correct Answer :</b> {{$q->answer}}
                    </div>
                </div>
                <hr>
                <?php } ?>
            
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-0">
                
                <a href="{{url('stud_mark')}}" class="btn btn-primary">
                    Back
                </a>
            </div>
        </div>
            </div>
    </div>
    </div>
</main>
@endsection
