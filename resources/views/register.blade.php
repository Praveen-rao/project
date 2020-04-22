<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ATG</title>

        <link rel="stylesheet" href="/css/app.css"/>
        <meta name = "csrf-token" content="{{csrf_token()}}"/>
    </head>
    <body>

    <div class="container col-md-5 offset-md-4 mt-5">
    <form id="userform" data-route="/api/registere" method="POST">
    <!-- {{ route('ATGregister')}} -->
     @csrf
        <div class="form-group">
            <label for="email">*Email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp ">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror        
        </div>
        <div class="form-group">
            <label for="username">username</label>
            <input type="text" name="username" class="form-control" id="username " >
            <!-- @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror           
             @error('username') is-invalid @enderror  -->
        </div>
        <div class="form-group">
            <label for="username">Pincode</label>
            <input type="number" name="pincode" class="form-control  @error('pincode') is-invalid @enderror" id="pincode">
            @error('pincode')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror   
        </div>

        <div id="messages"> </div>

        <button type="submit" class="btn btn-outline-primary"  >Submit</button>
    </form>
    
    </div>



    <div class="text-center pt-3 ">
    @include('flash::message')
    <!-- <p class="text-danger ">{{session('message')}}</p> -->
    </div>

   



      <script src="/js/app.js"></script>

      <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/atg.js')  }}" type="text/javascript"></script>


        <!-- <script>
        $('#submit').click(function()
        {
            jQuery.ajax({
                        url: "{{url('/api/registere')}}",
                        method : "POST",
                        data : {
                            email : jQuery('#email').val(),
                            username : jQuery('#username').val(),
                            pincode : jQuery('#pincode').val()
                        },
                        success : function(result)
                        {
                            jQuery('.alert').show();
                            jQuery('.alert').html(result.status);
                        }
                    });
        })

        // jQuery(document).ready(function(){
        //     jQuery('#submit').click(function(){
        //         // e.preventDefault();
        //         // $.ajaxSetup({
        //         //     headers:{
        //         //         'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
        //         //     }
        //         // })
        //         jQuery.ajax({
        //                 url: "{{url('/api/registere')}}",
        //                 method : "POST",
        //                 data : {
        //                     email : jQuery('#email').val(),
        //                     username : jQuery('#username').val(),
        //                     pincode : jQuery('#pincode').val()
        //                 },
        //                 success : function(result)
        //                 {
        //                     jQuery('.alert').show();
        //                     jQuery('.alert').html(result.status);
        //                 }
        //             });
        //     });
        // // });
        // // $("#Submit").click(function()
        // function submit()
        // {
        //      jQuery.ajax({
        //                 url: "{{url('/api/registere')}}",
        //                 method : "POST",
        //                 data : {
        //                     email : jQuery('#email').val(),
        //                     username : jQuery('#username').val(),
        //                     pincode : jQuery('#pincode').val()
        //                 },
        //                 success : function(result)
        //                 {
        //                     jQuery('.alert').show();
        //                     jQuery('.alert').html(result.status);
        //                 }
        //             });
        //         }           
        </script> -->


    </body>
</html>
