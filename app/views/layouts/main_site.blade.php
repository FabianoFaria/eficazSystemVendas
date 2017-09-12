<!DOCTYPE html>
<html lang="pt-BR">
    <head>

    	@include('includes.head_site')

    </head>


 	<body id="page-top">

 		<!-- <div id="wrapper"> -->


 			@include('includes.header_site')


 			@yield('content')  
 			
 		<!-- </div> -->

 		
        <!-- <div class="site-wrapper-inner">

            <div class="cover-container"> -->

              
               	<!--  @if(Session::has('message'))
                    <p class="alert">{{ Session::get('message') }}</p>
                 @endif -->

               
                @include('includes.footer_site') 

               
               

           <!--  </div>

        </div> -->
 
    </body>

    <!-- Bootstrap core JavaScript -->
    <script  src="{{URL::to('packages/js/jquery.js')}}" ></script>
    <script  src="{{URL::to('packages/js/bootstrap.min.js')}}" ></script>
    <script  src="{{URL::to('packages/js/popper.min.js')}}" type="text/javascript" ></script>

    <!-- Plugin JavaScript -->
    <script src="{{URL::to('packages/js/jquery.easing.min.js') }} "></script>

    <!-- Custom scripts for this template -->
    <script src="{{URL::to('packages/js/new-age.min.js') }}"></script>

</html>