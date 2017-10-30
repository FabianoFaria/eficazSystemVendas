@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">
              <h3 class="page-header">Orçamentos indicados por {{ $dadosVendedor->nome_vendedor }}</h3>
              <hr>

              	@if(! empty($solicitacao))

		            <h3 class='text-center'>{{ $solicitacao }} </h3>

		        @endif
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

				                  <!--  <a href="{{ URL::to('/solicitarPagamentoComissao') }}" class="btn btn-warning">
				                   		<i class="fa fa-pencil"></i> Solicitar pagamento
				                   </a> -->

				                   <!-- <a href="{{ URL::to('/solicitarPagamentoComissao') }}" class="btn btn-warning">
				                   		<i class="fa fa-pencil"></i> Historico pagamento
				                   </a> -->
				                        		
				            		<a class="btn btn-success" href="{{ url('/') }}"> 
				            			<i class="fa fa-undo"></i> Voltar
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	@if( empty($orcamentos))
		            		<h4>Nenhum orçamento com pagamento concluido ainda.</h4>
		            		<br>
		            		<hr>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                            <tr>
		                                <th>Título</th>
		                                <th>Data finalizada</th>
		                                <th>Status</th>
		                                <th>Comissão</th>
		                                <th>Data pagamento</th>
		                            </tr>
		                        </thead>

		                        <tbody>

		                        	@if(!empty($orcamentos))

		                        		@foreach($orcamentos as $orcamento)

		                        			<tr>
				                        		<td>
				                        			{{ $orcamento['Titulo'] }}
				                        		</td>
				                        		<td>
				                        			{{ $orcamento['Data_Finalizado'] }}
				                        		</td>
				                        		<td>
				                        			{{ $orcamento['Status'] }} 
				                        		</td>
				                        		<td>
				                        			{{ number_format($orcamento['totalServico'], 2) }}
				                        		</td>
				                        		<td>
				                        			{{ $orcamento['Data_Faturamento'] }}
				                        		</td>
				                        	<tr>

				                        	<!-- 

												'Titulo' => string 'Baterias juarez - bancos de baterias' (length=36)
											    'Data_Finalizado' => string '05/10/2017' (length=10)
											    'Proposta_ID' => int 414
											    'Forma_Pagamento_ID' => int 1357
											    'Data_Vencimento' => null
											    'Dias_Vencimento' => int 30
											    'Valor_Vencimento' => string '899.60' (length=6)
											    'totalServico' => string '899.60' (length=6)
											    'Data_Faturamento' => string '06/11/2017' (length=10)

				                        	-->


		                        		@endforeach

		                        	@endif

		                        </tbody>
		    				</table>


		    			@endif


		            </div>

    			</div>

    		</div>

    	</div>
    </section>

@endsection()