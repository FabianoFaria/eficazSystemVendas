@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">


    		<div class="section-heading text-center">
              <h3 class="page-header">Confirmação de pagamento de comissão. {{ $orcamentoId }}</h3>
            
            </div>

            <div class="row">

            	<div class="panel panel-default">

            		<div class="panel-heading">
		        		<div class="row">
		            		<div class="col-lg-6">

		            		</div>
		            		<div class="col-lg-6">
			            	
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	<p>Foi registrado o pagamento para o orçamento de número {{ $orcamentoId }}</p>

		            	<p>
		            		O parceiro deverá receber a comissão conforme as informações que foram passadas na tela de registro de pagamento.
		            	</p>

		            	<p>
		            		Caso esteja tudo em ordem, poderá efetuar o fechamento desta janela.
		            	</p>
		            </div>

            	</div>

            </div>

		</div>
	</section>

@endsection()