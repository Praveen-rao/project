<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ATG</title>

        <link rel="stylesheet" href="/css/app.css"/>
    </head>
    <body>

    <div class="container col-md-5 offset-md-4 mt-5">
    <form action="{{ route('ATGregister')}}" method="POST">
    @csrf
        <div class="form-group">
            <label for="email">*Email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp ">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror        
        </div>
        <div class="form-group">
            <label for="username">username</label>
            <input type="text" name="username" class="form-control" id="exampleInputPassword1 " >
            <!-- @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror           
             @error('username') is-invalid @enderror  -->
        </div>
        <div class="form-group">
            <label for="username">Pincode</label>
            <input type="number" name="pincode" class="form-control  @error('pincode') is-invalid @enderror" id="exampleInputPassword1">
            @error('pincode')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror   
        </div>

        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
    
    </div>


    <div class="text-center pt-3 ">
    <p class="text-danger ">{{session('message')}}</p>
    </div>


      <script src="/js/app.js"></script>
    </body>
</html>
