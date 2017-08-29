<!DOCTYPE html>
<html lang="en">
    <head>


        @include('includes.head')

        <link rel="stylesheet" href="{{ URL::asset('packages/css/login.css') }}">

    </head>
   
 
    <body style="background: url({{ URL::asset('img/background.png') }});">


        <div class="site-wrapper-inner">

            <div class="cover-container">

              
                @if(Session::has('message'))
                    <p class="alert">{{ Session::get('message') }}</p>
                 @endif


                @yield('content')  



               
                @include('includes.footer')
               

            </div>

        </div>
 
    </body>
</html>