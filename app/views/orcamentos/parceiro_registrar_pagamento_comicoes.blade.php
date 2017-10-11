@extends('layouts.main_site')

@section('content')
	
	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">
              <h3 class="page-header">Comissão ser paga para {{ $parceiro[0]->nome_usuario }}</h3>
            
            </div>


            <div class="row">

            	<div class="panel panel-default">

            		<div class="panel-heading">
		        		<div class="row">
		            		<div class="col-lg-6">

		            		</div>
		            		<div class="col-lg-6">
			            		<div id="dataTables-example_filter" class="dataTables_filter pull-right">
				            		<!-- <a class="btn btn-primary" href="{{ url('/orcamentos/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar novo orçamento
				            		</a> -->
				            		<!-- <a class="btn btn-success" href="{{ url('/') }}"> 
				            			<i class="fa fa-undo"></i> Voltar
				            		</a> -->
			            		</div>
		            		</div>
		            	</div>
		            </div>

            		<div class="panel-body">

            			@if( empty($orcamentos))

		            		<h4>Orçamento não foi encontrado ou comissão do orçamento já foi pago.</h4>

		    			@else

		    				<h3 class="text-center">Orçamento : {{ $orcamentos[0]['Titulo'] }}</h3>

		    				<br>

		    				<!-- <p>
		    					Data finalizado : {{ $orcamentos[0]['Data_Finalizado'] }}
		    				</p> -->

		    				<p class="text-center">
		    					Data para pagamento : {{ $orcamentos[0]['Data_Faturamento'] }}
		    				</p>

		    				<p class="text-center">
		    					Data para pagamento : R$ {{ number_format( $orcamentos[0]['Valor_Vencimento'], 2) }}
		    				</p>

		    				<hr>

		    				<div class="row">

		    					<div class="col-md-6 col-md-offset-3">

		    						{{ Form::open(array('route'=> 'orcamentos.gardar_pgmt', 'class'=>'form', 'method'=>'post')) }}

		    							<div class="form-group">

		    								{{ Form::hidden('id_orcamento', $orcamentos[0]['Workflow_ID'], array('id' => 'id_orcamento')) }}
		    								{{ Form::hidden('id_usuario', $parceiro[0]->id, array('id' => 'id_usuario')) }}

		    								{{ Form::Label('observacao_pgmt', 'Observação do pagamento') }}
		    								{{ Form::textarea('observacao_pgmt', null, array( 'id'=>'observacao_pgmt', 'class'=>'form-control', 'placeholder'=>'Detalhes do pagamento.')) }}
			                   	 			{{ $errors->first('observacao_pgmt', '<span class=inputError>:message</span>') }}

		    							</div>

			                   	 		<div class="form-group">
						                    {{ Form::submit('Registrar pagamento', array('class'=>'btn btn-large btn-primary btn-block'))}}
						                </div>

		    						{{ Form::close() }}

		    					</div>

		    				</div>

		    			@endif

		    			<!-- 
							
							'Workflow_ID' => int 263
						    'Titulo' => string 'Baterias juarez - bancos de baterias' (length=36)
						    'Data_Finalizado' => string '05/10/2017' (length=10)
						    'Proposta_ID' => int 414
						    'Forma_Pagamento_ID' => int 1357
						      'Data_Vencimento' => null
						      'Dias_Vencimento' => int 30
						      'Valor_Vencimento' => float 73.7672
						      'totalServico' => float 73.7672
						      'Status' => string 'Fechado (Orç Aprovado)' (length=23)
						      'tipoPagamento' => string 'Boleto (30 dias)' (length=16)
						      'Data_Faturamento' => string '09/11/2017' (length=10)

		    			-->

            		</div>

            	</div>

            </div>

    	</div>
    </section>

@endsection()