<!DOCTYPE html>
<html lang="pt-BR">
    <head>


        @include('includes.head_site')

       <!--  <link rel="stylesheet" href="{{ URL::asset('packages/css/login.css') }}"> -->

    </head>
   
 
    <!-- <body style="background: url({{ URL::asset('img/background.png') }});"> -->
    <body  id="page-top">


        @include('includes.header_site')


        <!-- <div class="site-wrapper-inner">

            <div class="cover-container"> -->

              
                @if(Session::has('message'))
                    <p class="alert">{{ Session::get('message') }}</p>
                 @endif


                @yield('content')  



               
                @include('includes.footer_site')
               

          <!--   </div>

        </div> -->
 
    </body>
</html>