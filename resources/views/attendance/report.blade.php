<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.8 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    

    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- Javascript -->
      
      <script>
         $(function() {
            $( "#datepicker-8" ).datepicker({
               prevText:"click for previous months",
               nextText:"click for next months",
               showOtherMonths:true,
               selectOtherMonths: false
            });
            $( "#datepicker-9" ).datepicker({
               prevText:"click for previous months",
               nextText:"click for next months",
               showOtherMonths:true,
               selectOtherMonths: true
            });
         });
      </script>
</head>
<body>
  <div class="container-fuild">
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
  </div> 
 
  <h3 class="text-center">Attendance Reports</h3>
  <div class="container p-4 bg-grey" style="">
    <div class="row">
      <div class="col">
        <label>From Date</label>
        <input type = "text" id ="datepicker-8" class="form-control" placeholder="From Date">
      </div>
      <div class="col">
        <label>To Date</label>
        <input type = "text" id ="datepicker-9" class="form-control" placeholder="To Date">
      </div>
      <div class="col"><br><br>
        <input type="button" value="Submit" class="btn btn-success searchData">
      </div>
    </div> 
  
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h4>Attendance Report</h4>
      </div>
    </div>
    <div class="card-body">
    <table class="table data-table table-responsive-sm">
        <thead>
            <tr class="font-weight-bold">             
                <td scope="col">Sr No</td>
                <td scope="col">Name</td>
                <td scope="col">Date</td>
                <td scope="col">In / Out</td>
                <td scope="col">Session Duration</td>
                <td scope="col">Status</td>
              </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>
  </div>
</div>
   
</body>
   
<script type="text/javascript">
  $(function () {
   var table = $('.data-table').DataTable();
function loadData()
{
  var from = $('#datepicker-8').val();
  var to = $('#datepicker-9').val();
  $.ajax({
    type:'GET',
    url:"{{ url('attendance/getData') }}",
    data:{from:from,to:to},
    success:function(res){
      $('tbody').empty();
      $('tbody').html(res);
    }
  })
}
    //$(".data-table").append('<tfoot><tr><th>1</th>2<th>3</th><th>3</th><th>3</th><th>3</th><th>3</th><th>3</th></tr></tfoot>');
    $('.searchData,.data-table').on('click', function(e) {
       loadData();
       e.preventDefault();
       table.draw();
  });

  $('input[type="search"]').on( 'keyup', function () {
     var search = $(this).val();
     loadData();
  });
  $('.data-table').on('length.dt', function ( e, settings, len ) {
   loadData();
} );

  });
</script>
</html>