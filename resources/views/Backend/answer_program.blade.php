@extends('layouts.app')
@section('title', 'Register Students')
@section('content')
<?php
$answer = json_decode($stud_answer->stud_ans,true);
$info = \App\User::select('name')->where(['id'=>$stud_answer->stud_id])->first();
//echo "<pre>";print_r($answer);exit;
$x = 1; ?>
<link href="notepad-css/bootstrap.css" rel="stylesheet">
<link href="notepad-css/dist/summernote.css" rel="stylesheet">
<main class="app-content" >
    <div class="app-title" style="position: fixed;z-index: 1;width: 93%;">
        <div>
            <h1> Program Answer Paper </h1>
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
	<form action="{{url('answer-program')}}" method="POST">
	{{ csrf_field() }}
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group row">
                    <div class="col-md-12" style="color:black">
                        <p style="white-space: pre-line;"><b>Student Name : {{$info->name}}</b><p>
                        <p style="white-space: pre-line;"><b>Total Score : {{$stud_answer->score}}</b><p>
                    <hr>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea  class="summernote"> {{$stud_answer->program_answer}}</textarea>
                    </div>
				</div>
				 <input type="hidden" name="id" value="{{$stud_answer->id}}" />
				<div class="form-group row">
					<label class="control-label col-md-4">Marks</label>
					<div class="col-md-8">
						<input type="text" name="prog_marks" id="prog_marks" class="required form-control" />
					</div>
				</div>
					
                </div>
		 </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-0">
                <input type="submit" class="btn btn-primary" value="submit" />
                <a href="{{url('stud_mark')}}" class="btn btn-primary">
                    Back
                </a>
            </div>
        </div>
		</form>
            </div>
    </div>
    </div>
</main>
<script src="notepad-css/js/jquery.js"></script> 
<script src="notepad-css/js/bootstrap.js"></script> 
<script src="notepad-css/js/summernote.js"></script>
<script>
            $(".summernote").summernote({
                styleWithSpan: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
//                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                  ],
            });
//            $('.summernote').summernote({ height: 250 });
</script>
@endsection
