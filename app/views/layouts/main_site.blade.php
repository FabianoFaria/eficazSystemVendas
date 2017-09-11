<!DOCTYPE html>
<html lang="pt-BR" prefix="og: http://ogp.me/ns#">
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
</html>