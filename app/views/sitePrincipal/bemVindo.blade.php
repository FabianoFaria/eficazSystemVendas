
@extends('layouts.main_site')

@section('content')

	<section class="cta register_page">
        <div class="cta-content">
	        <div class="container">
	            <div class="row">

	            	<div class="col-md-5 col-md-offset-4">

	            		<div class="panel">

	            			<div class="panel-heading">
	            				<div class="row"> 
	            					<div class="imgLogin col-md-offset-3">
	                                
	                                <a class="" href="{{ URL::to('/') }}">
	                                    <img src="{{ URL::asset('img/eficazlogo.jpg') }}">
	                                </a>
	                            </div>
	            				</div>
	                        </div>

	                        <div class="panel-body">


	                        	<h2 class="titulo-boas-vindas">Bem vindo ao time de parceiros da Eficaz System.</h2>

	                        	<p>
	                        		A partir de agora você poderá começar a efetuar suas indicações de nossos serviços e começar a ganhar suas comissões.
	                        	</p>
	                        	<p>
	                        		Acesse sua conta e complete seu cadastro para que possa plenamente desfrutar de nosso sistema.
	                        	</p>

	                        	<a href="{{ URL::to('/login') }}" style="color:#ffffff;" class="btn btn-success btn-acessar-conta btn-block">Acessar sua conta.</a>

	                        </div>

	            		</div>


	            	</div>

	            </div>
	        </div>
	    </div>
	</section>


@endsection()
