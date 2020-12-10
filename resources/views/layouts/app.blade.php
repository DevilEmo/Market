<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/dd0c5c43bd.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html{
            overflow: hidden;
            min-height: 100vh;
        }
        main{
            overflow: auto;
            height: calc(100% - 75px);
            
            background-color: whitesmoke;
        }
        .navbar-nav .active{
            /* border: 2px solid seagreen; */
            /* border-radius: 2px; */
        }
        .navbar{
            z-index: 1;
            letter-spacing: -1.7px;
            word-spacing: 3px;
            font-size:medium;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <main class="pt-4" style="background-color:darkgray;opacity:0.95;">
            <div class="container mb-4" style="opacity:0.95;background-color:whitesmoke;border-radius:8px;padding:20px;min-height:calc(100% - 55px)">
                @include('inc/messages')
                @yield('content')
            </div>
        </div>
                 <div class="{{ Request::is('/') ? 'd-block' : 'd-none'}}">
                     @include('inc.footer')
                </div>     
        </main>
</body>

<script type="text/javascript">
       function checkForm(form)
        {
          //
          // validate form fields
          //
      
          form.myButton.disabled = true;
          return true;
        }
  </script>
  
</html>
