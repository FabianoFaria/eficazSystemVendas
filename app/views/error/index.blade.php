@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-12">

					<h3 class="page-header">Informção não encontrada</h3>

					<p> Parece que a informação que está procurando não foi encontrada ou foi procurada de maneira incorreta. </p>
	          			
	          		<hr>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12 my-auto">

					<div class="container-fluid">

						<div class="row">

							<div class="col-lg-6">
			                  <div class="feature-item">
			                    
			                    <h3>O que fazer a partir de agora?</h3>

			                    <p>
			                    	Lamentamos o ocorrido, espero que encontre a informação que está procurando retornando a página inicial do site.
			                    </p>                 

			                  </div>
			                </div>


			                <div class="col-lg-6">
			                  <div class="feature-item">
			                    <i class="icon-phone text-primary"></i>
			                    
				    			<p><a href="{{ URL::to('/') }}" class="btn btn-primary"> Voltar a página inicial. </a></p>

			                  </div>
			                </div>

						</div>

						<div class="row">
													
			                <div class="col-lg-12">
			                
			                </div>

						</div>

					</div>

				</div>

			</div>

    	</div>
    </section>

    <hr>

@endsection()