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
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>

        .loader{
            display: none;
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('public/loader.gif') }}") 
                        50% 50% no-repeat rgb(249,249,249);
          }
body
{
    counter-reset: count;           /* Set the Serial counter to 0 */
}
tr .sr_no:first-child:before
{
  counter-increment: count;      /* Increment the Serial counter */
  content:counter(count)"."; /* Display the counter */
}
    </style>
</head>
<body>
    <div class="loader"></div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('favirote') }}">Favirote </a>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#postModal">Add New</a>
                        </li> 

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


       <main class="py-4">
            <main class="container bg-white" style="box-shadow: 2px 2px 2px grey">
                <center>
                <form action="{{ url('orderSave') }}" method="POST">
                    @csrf();
                <table class="table" align="center">
                   <thead class="text-center">
                    <tr>
                        <th>Sr No</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                   </thead>
                   <tbody id="body">
                       <tr>
                        <td class="sr_no"></td>
                        <td>
                            <select name="category[]" class="category calculate form-control form-control-sm">
                                <option>Select</option>
                                @foreach($categories as $val)
                                 <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><select name="product[]" class="product calculate form-control form-control-sm">
                            <option>Select</option>
                            </select>
                        </td>
                        <td><input type="number" name="price[]" class="price calculate form-control form-control-sm w-100" placeholder="Price" readonly></td>
                        <td><input type="number" name="quantity[]" class="quantity calculate form-control form-control-sm w-100" placeholder="Quantity" value="0"></td>
                        <td><input type="number" name="amount[]" class="amount calculate form-control form-control-sm w-100" placeholder="Amount" value="0" readonly></td>
                        <td><button class="btn btn-success add ml-1">+</button><button class="btn btn-danger remove ml-1">-</button></td>
                       </tr>
                   </tbody>
                   <tfoot>
                       <tr>
                           <td colspan="5">Total</td>
                           <td><input type="number" name="total" class="total calculate form-control form-control-sm w-100" placeholder="Total" value="0"></td>
                       </tr>
                   </tfoot>
                </table>
                <input type="submit" value="Submit" class="btn btn-success m-3">
            </form>    
            </center>
            </main>   

<script>
    $(document).ready(function(){
        var clone = $('#body').clone().html();
        $(document).on('click','.add',function(e){
            e.preventDefault()
            $('table').append(clone);
            calculate()
        })

        
        $(document).on('click','.remove',function(e){
           e.preventDefault()
           var length = $('#body tr').length;
           if(length > 1){
               $(this).closest('tr').remove();
               calculate()
           }
        })

        $(document).on('keyup','.quantity',function(){
            calculate();
          })

        function calculate(){
            var quantity = $(this);
            var grandTotal = 0;
            $('.quantity').each(function(){
                var quantity = parseInt($(this).val());
                var price = parseInt($(this).closest('tr').find('.price').val());
                amount = price * quantity;
                $(this).closest('tr').find('.amount').val(amount.toFixed(2));
            })

            $('.amount').each(function(){
                var amount = parseInt($(this).val());
                grandTotal = grandTotal + amount;

                $('.total').val(grandTotal.toFixed(2));
            });
            
            
        }
        calculate();
        $(document).on('change','.category',function(){
            var id = $(this).find(':selected').val();
            var setProduct = $(this).closest('tr').find('.product');
            var setPrice = $(this).closest('tr').find('.price');
            setProduct.prop('disabled', true);
            setPrice.prop('disabled', true);
            var _token = '{{ csrf_token() }}';           
            $.ajax({
                type:'POST',
                url:"{{ url('getProduct') }}",
                data:{id:id,_token:_token},
                success:function(res){
                  setProduct.empty();
                  if(res.length > 0){    
                  setProduct.append("<option selected>Select Product</option>")
                  $.each(res,function(key,value){
                    setProduct.append("<option value="+value.id+">"+value.name+"</option>")
                  })
                }else{
                    setProduct.append("<option>No Product</option>")
                }
                calculate();
                setProduct.prop('disabled', false);
                setPrice.prop('disabled', false);
            }
            })
        })


        $(document).on('change','.product',function(){
            calculate()
            var id = $(this).find(':selected').val();
            if(id != ''){
            var setPrice = $(this).closest('tr').find('.price');
            setPrice.prop('disabled', true);
            var _token = '{{ csrf_token() }}';           
            $.ajax({
                type:'POST',
                url:"{{ url('getPrice') }}",
                data:{id:id,_token:_token},
                success:function(res){
                    calculate();  
                    setPrice.val('');
                    setPrice.val(res);
                    setPrice.prop('disabled', false);
                }
            })
        }
        })

      
    })
</script>


</body>
</html>
