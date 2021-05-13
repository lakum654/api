<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Attendance</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('attendance') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('attendance/report') }}">Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="container py-4">
    <h4 class="text-center">Work Time</h4>
    <div class="btn-area text-center" style="margin-top:100px">
        <div class="btns">
            @if($checkOut > 0)
            <a class="btn btn-success text-white">{{ date('h:i:s A') }}</a>
            <a class="btn btn-danger text-white outBtn" id="outBtn" href="{{ url('attendance/out') }}">Out Entry <i class="fa fa-sign-out"></i></a>
            @else
            <a class="btn btn-success text-white" id="inBtn" href="{{ url('attendance/in') }}"><i class="fa fa-sign-in"></i> In Entry</a>
            @endif                           
        </div>
    </div>
  </div>     
    <!-- Main content -->
  <section class="content">		
  <center>  
  @foreach($attendance as  $value)
  <a  disabled="disabled" class="btn btn-sm btn-success m-2 text-white"> <i class="fa fa-clock"></i> {{ date('h:i A',strtotime($value->in_time)) }}</a>
	<a  disabled="disabled" class="btn btn-sm btn-danger text-white"> <i class="fa fa-clock"></i> {{ date('h:i A',strtotime($value->out_time)) }} </a><br>
  @endforeach  
	<br>
	<button class="btn btn-lg btn-primary bg-dark" data-worktime="{{ Session::get('workingHours') != '' ? Session::get('workingHours') : '0'}}" id="workingHours">
  	<i class='fa fa-watch'></i> :{{ Session()->get('wholeTime') }}
 </button>
	</center>

    </section>
    <!-- /.content -->

    
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  /*if($('#check').data('data') == 1)
  {
      var count = 1;
      var interval = setInterval(function (){    
         count = count + 1;
         $('#workingHours').data('worktime',count);
     }, 1000);



     var interval = setInterval(function (){    
      var linkUrl = 'attendance/startWork/0';
      window.location = linkUrl;
    }, 5000);     
}*/

    

  $('#inBtn').click(function(event){
    event.preventDefault()
    var linkUrl = $(this).attr('href');
    swal({
      title: "Are you sure ?",
      text: "Want In Entry",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var d = new Date();
        var currentTime = d.toLocaleTimeString();
        $('#outBtn').text(currentTime);
        window.location = linkUrl;
      } else {
        swal("Cancelled",'success');
      }
    });    
   
  })

  $('#outBtn').click(function(event){
    event.preventDefault()
    var linkUrl = $(this).attr('href');
    swal({
      title: "Are you sure ?",
      text: "Want Out Entry",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var worktime = $('#workingHours').data('worktime');
        var d = new Date();
        var currentTime = d.toLocaleTimeString();
        window.location = linkUrl+'/'+worktime;
      } else {
        swal("Cancelled",'success');
      }
    });    
   
  })

</script>
{{--  <script>
    jQuery.validator.setDefaults({
        debug: false,
        success: "valid"
      });
      $( "#myForm" ).validate({
        rules: {
          title: {
            required: true
          }
        }
      });
</script>  --}}
</body>
</html>
