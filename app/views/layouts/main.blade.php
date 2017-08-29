<!DOCTYPE html>
<html lang="en">
    <head>

    	@include('includes.head')

    	<link rel="stylesheet" href="{{ URL::asset('packages/css/main.css') }}">

    </head>


 	<body>

 		<div id="wrapper">


 			@include('includes.header_admin')


 			@yield('content')  
 			
 		</div>

 		
        <!-- <div class="site-wrapper-inner">

            <div class="cover-container"> -->

              
               	<!--  @if(Session::has('message'))
                    <p class="alert">{{ Session::get('message') }}</p>
                 @endif -->


                
                		



               
                <!-- @include('includes.footer')  -->

               
               

           <!--  </div>

        </div> -->
 
    </body>
</html>