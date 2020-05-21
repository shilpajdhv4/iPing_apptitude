@extends('layouts.app_apti')
@section('title', 'Home')
@section('content')
<style>
    .control-label{
        font-weight: bold;
    }
    
    .not-active {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
  color: black;
}
</style>
<?php
Auth::user()->google_id;
$clg = Auth::user()->collage_name;
$activation = \App\Activation::orderBy('id', 'desc')->first();
?>
<main class="app-content" style="margin: 50px;">
    <!--    <div class="app-title">
            <div>
                <h1>Welcome To Online Aptitude Test</h1>
            </div>
        </div>-->
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align:center;">Welcome To Online Test</h2>
            <br/>
            <?php if($clg == "") { ?>
            <form method="POST" action="{{ route('register') }}" id="orderForm">
                @csrf
                <div class="form-group row">
                    <label for="collage_name" class="col-md-4 col-form-label text-md-right">College Name</label>
                    <div class="col-md-6">
                        <!--<input id="collage_name" type="text" class="form-control @error('collage_name') is-invalid @enderror" name="collage_name" value="{{ old('collage_name') }}" required autocomplete="collage_name">-->
                        <select class="form-control" id="collage_name" name="collage_name" type="text" required="required">
                            <option value="">-- Please select College Name--</option>
                            <option value="ADJoshi" <?php if($clg == "ADJoshi") echo "selected"; ?>>A D Joshi Junior College</option>>
                            <option value="AGPIT" <?php if($clg == "AGPIT") echo "selected"; ?>>A.G. Patil Institute Of Technology</option>
                            <option value="Burla" <?php if($clg == "Burla") echo "selected"; ?>>A R Burla Mahila Varishtha Mahavidyalaya, Solapur</option>
                            <option value="BVS" <?php if($clg == "BVS") echo "selected"; ?>>Bharati Vidyapeeth, Solapur</option>
                            <option value="BMIT" <?php if($clg == "BMIT") echo "selected"; ?>>Brahmdevdada Mane Institute of Technology</option>
                            <option value="BMP" <?php if($clg == "ADJoshi") echo "selected"; ?>>Brahmdevdada Mane Polytechnic</option>
                            <option value="Velankar" <?php if($clg == "Velankar") echo "selected"; ?>>DAV Velankar College of Commerce, Solapur</option>
                            <option value="Dayanand" <?php if($clg == "Dayanand") echo "selected"; ?>>DBF Dayanand College of Arts and Science, Solapur</option>
                            <option value="Soni" <?php if($clg == "Soni") echo "selected"; ?>>DHB SONI COLLEGE, SOLAPUR</option>
                            <option value="GP" <?php if($clg == "GP") echo "selected"; ?>>Government Polytechnic, Solapur</option>
                            <option value="HN" <?php if($clg == "HN") echo "selected"; ?>>Hirachand Nemchand College of Commerce, Solapur</option>
                            <option value="MIM" <?php if($clg == "MIM") echo "selected"; ?>>Mangalvedhekar Institute of Management, Solapur</option>
                            <option value="Orchid" <?php if($clg == "Orchid") echo "selected"; ?>>Nagesh Karajagi Orchid College Of Engineering Technology</option>
                            <option value="Sinhgad" <?php if($clg == "Sinhgad") echo "selected"; ?>>N. B. Navale Sinhgad College Of Engineering</option>
                            <option value="Sangameshwar" <?php if($clg == "ADJoshi") echo "selected"; ?>>Sangameshwar College, Solapur</option>
                            <option value="SIET" <?php if($clg == "SIET") echo "selected"; ?>>Shriram Institute Of Engineering And Technology Centre, Solapur</option>
                            <option value="SESP" <?php if($clg == "SESP") echo "selected"; ?>>Solapur Education Society Polytechnic, Solapur</option>
                            <option value="SPM" <?php if($clg == "SPM") echo "selected"; ?>>SPM Polytechnic College</option>
                            <option value="SU" <?php if($clg == "SU") echo "selected"; ?>>Solapur University</option>
                            <option value="SSWP" <?php if($clg == "SSWP") echo "selected"; ?>>Shri Siddheshwar Women's Polytechnic College</option>
                            <option value="SVERI" <?php if($clg == "SVERI") echo "selected"; ?>>Shri Vithal Education and Research Institute College of Engineering, Solapur</option>
                            <option value="SVIT" <?php if($clg == "SVIT") echo "selected"; ?>>Swami Vivekananda Institute Of Technology</option>
                            <option value="VVP" <?php if($clg == "VVP") echo "selected"; ?>>Vidya Vikas Pratishthan Institute Of Engineering & Technology</option>
                            <option value="WIT" <?php if($clg == "WIT") echo "selected"; ?>>Walchand Institute Of Technology, Solapur</option>                                            
                            <option value="Other" <?php if($clg == "Other") echo "selected"; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-group row" id="msg_div" style="display:none">
                            <label id="msg" class="error" for="name" style="color:#dc3545"></label>
                         </div>
                        <button type="button" id="btnsubmit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
            <br/>
            <br/>
            <?php } ?>
            <div id="abc" style="display:none;" >
                <div class="row">
                    <div class="col-md-6 col-lg-4"></div>
                    <?php $apti_test_id = Auth::user()->apti_flag; 
                          $user_id = Auth::user()->id;
                          if (\App\Answer::where('stud_id', $user_id)->exists()) { ?>
                            <div class="col-md-6 col-lg-4" style="margin-left: 64px;">
                                <b>You Have Already Given Aptitude Test </b>
                            </div>
                    <?php }
                          else if ($activation->apti_test == "on" && $apti_test_id == 0) { ?>
                            <div class="col-md-6 col-lg-3" style="margin-left: 38px;">
                                <a href="{{url('test')}}" class="btn btn-primary btn-lg" >Click Here To Start Aptitude Test</a>
                            </div>
                    <?php } ?>
                </div>
                 <br/>
                 <div class="row">
                    <div class="col-md-6 col-lg-4"></div>
                <?php 
                    $prog_test_id = Auth::user()->program_flag;
                    if ($activation->program_test == "on" && $prog_test_id == 0) { ?>
                    <div class="col-md-6 col-lg-3" style="margin-left: 28px; "   >
                        <a href="{{url('programing_questions')}}" class="btn btn-primary btn-lg <?php if($apti_test_id == 0) { ?> not-active <?php } ?>" >Click Here To Start Programing Test</a>
                    </div>
                <?php }else{ ?>
                    <div class="col-md-6 col-lg-4" style="margin-left: 50px;">
                        <b>You Have Already Given Programming Test </b>
                    </div>
                <?php } ?>
                        
            </div>
        </div>
    </div>
</main>
<script type="text/javascript" src="js/plugins/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var clg = $("#collage_name").val();
        if(clg == ""){
            $("#abc").css("display","none");
        }else{
            $("#abc").css("display","block");
        }
        $("#btnsubmit").on("click",function(){
            var clg = $("#collage_name").val();
            if(clg == ""){
                $("#msg_div").css("display","block");
                $("#msg").html("Please Select College Name");
            }
            else{
                var formData = $('#orderForm').serialize();
                console.log(formData);
                $.ajax({
                    url: 'update_user',
                    type: "post",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        $("#msg_div").css("display","none");
                        $("#abc").css("display","block");
                    }
               })  
           }
        })
    })
    
</script>
@endsection
