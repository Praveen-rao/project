<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ATG</title>

        <link rel="stylesheet" href="/css/app.css"/>
    </head>
    <body>

    <div class="container col-md-5 offset-md-5 mt-5 ">
        Hello Click <a href ="{{route('ATGindex')}}">here</a> to register!!
    
    </div>
    <div class="text-center">
    <p>{{session('status') }}</p>
    </div>
    

      <script src="/js/app.js"></script>
    </body>
</html>
