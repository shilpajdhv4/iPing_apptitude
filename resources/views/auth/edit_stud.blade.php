@extends('layouts.app')
@section('title', 'Register')
@section('content')

<!--<section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <img src="logo.png" />
      </div>-->
<style>
    .error{
        color: #dc3545;
    }
  </style>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Register Students List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#">Student</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header" style="text-align: center;"><b>Edit Registration Form</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ url('edit_stud/'.$stud_data->id) }}" id="orderForm">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$stud_data->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$stud_data->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-right">Mobile No</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{$stud_data->mobile_no}}" required autocomplete="mobile_no">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                    <label for="collage_name" class="col-md-4 col-form-label text-md-right">College Name</label>
                    <div class="col-md-6">
                        <!--<input id="collage_name" type="text" class="form-control @error('collage_name') is-invalid @enderror" name="collage_name" value="{{ old('collage_name') }}" required autocomplete="collage_name">-->
                        <select class="form-control" id="collage_name" name="collage_name" type="text" required="required">
                            <option value="">-- Please select College Name--</option>
                            <option value="ADJoshi" <?php if($stud_data->collage_name == "ADJoshi") echo "selected"; ?>>A D Joshi Junior College</option>>
                            <option value="AGPIT" <?php if($stud_data->collage_name == "AGPIT") echo "selected"; ?>>A.G. Patil Institute Of Technology</option>
                            <option value="Burla" <?php if($stud_data->collage_name == "Burla") echo "selected"; ?>>A R Burla Mahila Varishtha Mahavidyalaya, Solapur</option>
                            <option value="BVS" <?php if($stud_data->collage_name == "BVS") echo "selected"; ?>>Bharati Vidyapeeth, Solapur</option>
                            <option value="BMIT" <?php if($stud_data->collage_name == "BMIT") echo "selected"; ?>>Brahmdevdada Mane Institute of Technology</option>
                            <option value="BMP" <?php if($stud_data->collage_name == "ADJoshi") echo "selected"; ?>>Brahmdevdada Mane Polytechnic</option>
                            <option value="Velankar" <?php if($stud_data->collage_name == "Velankar") echo "selected"; ?>>DAV Velankar College of Commerce, Solapur</option>
                            <option value="Dayanand" <?php if($stud_data->collage_name == "Dayanand") echo "selected"; ?>>DBF Dayanand College of Arts and Science, Solapur</option>
                            <option value="Soni" <?php if($stud_data->collage_name == "Soni") echo "selected"; ?>>DHB SONI COLLEGE, SOLAPUR</option>
                            <option value="GP" <?php if($stud_data->collage_name == "GP") echo "selected"; ?>>Government Polytechnic, Solapur</option>
                            <option value="HN" <?php if($stud_data->collage_name == "HN") echo "selected"; ?>>Hirachand Nemchand College of Commerce, Solapur</option>
                            <option value="MIM" <?php if($stud_data->collage_name == "MIM") echo "selected"; ?>>Mangalvedhekar Institute of Management, Solapur</option>
                            <option value="Orchid" <?php if($stud_data->collage_name == "Orchid") echo "selected"; ?>>Nagesh Karajagi Orchid College Of Engineering Technology</option>
                            <option value="Sinhgad" <?php if($stud_data->collage_name == "Sinhgad") echo "selected"; ?>>N. B. Navale Sinhgad College Of Engineering</option>
                            <option value="Sangameshwar" <?php if($stud_data->collage_name == "ADJoshi") echo "selected"; ?>>Sangameshwar College, Solapur</option>
                            <option value="SIET" <?php if($stud_data->collage_name == "SIET") echo "selected"; ?>>Shriram Institute Of Engineering And Technology Centre, Solapur</option>
                            <option value="SESP" <?php if($stud_data->collage_name == "SESP") echo "selected"; ?>>Solapur Education Society Polytechnic, Solapur</option>
                            <option value="SPM" <?php if($stud_data->collage_name == "SPM") echo "selected"; ?>>SPM Polytechnic College</option>
                            <option value="SU" <?php if($stud_data->collage_name == "SU") echo "selected"; ?>>Solapur University</option>
                            <option value="SSWP" <?php if($stud_data->collage_name == "SSWP") echo "selected"; ?>>Shri Siddheshwar Women's Polytechnic College</option>
                            <option value="SVERI" <?php if($stud_data->collage_name == "SVERI") echo "selected"; ?>>Shri Vithal Education and Research Institute College of Engineering, Solapur</option>
                            <option value="SVIT" <?php if($stud_data->collage_name == "SVIT") echo "selected"; ?>>Swami Vivekananda Institute Of Technology</option>
                            <option value="VVP" <?php if($stud_data->collage_name == "VVP") echo "selected"; ?>>Vidya Vikas Pratishthan Institute Of Engineering & Technology</option>
                            <option value="WIT" <?php if($stud_data->collage_name == "WIT") echo "selected"; ?>>Walchand Institute Of Technology, Solapur</option>                                            
                            <option value="Other" <?php if($stud_data->collage_name == "Other") echo "selected"; ?>>Other</option>
                        </select>
                    </div>
                </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{url('stud_list')}}" class="btn btn-secondary">
                                    Cancel
                                </a>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<script type="text/javascript" src="js/plugins/jquery.min.js"></script>
<script type='text/javascript' src='js/plugins/jquery.validate.js'></script>
<script type="text/javascript">
//            $("#btnsubmit").on("click",function(){
$(document).ready(function($){
    $cf = $('#mobile_no');
    $cf.blur(function(e){
        phone = $(this).val();
        phone = phone.replace(/[^0-9]/g,'');
        if (phone.length != 10)
        {
            $("#mobile_no_1").html('Phone number must be 10 digits.');
            $('#mobile_no').val('');
            $('#mobile_no').focus();
        }
    });
});

            var jvalidate = $("#orderForm").validate({
                rules: {                                            
                        name: {required: true},
                        email: {required: true},
                        mobile_no: {required: true},
                        collage_name: {required: true},
                       
                    },
                     messages: {
                         name: "Please Enter Name",
                         email: "Please Enter Email Address",
                         mobile_no: "Please Enter Mobile No",
                         collage_name : "Please Select College Name",
                         password: "Please Enter Password"
                       }  
                });
                
                $('#btnsubmit').on('click', function() {
                    $("#orderForm").valid();
                });
                
                $('.number1').keypress(function(event){
                    var phone = $(this).val();
                    phone = phone.replace(/[^0-9]/g,'');
                    if (phone.length != 10)
                    {
                        $("#mobile_no_1").html('Phone number must be 10 digits.');
                    }
                })
                
                $('.number').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 5) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 5) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
    }      
});
                
        </script>
        
@endsection

