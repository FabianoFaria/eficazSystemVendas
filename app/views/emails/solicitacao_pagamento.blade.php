@extends('layouts.email')

@section('content')


	<!-- Email Body : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" style="margin: auto;" class="email-container">


    	<!-- 1 Column Text : BEGIN -->
        <tr>

        	<td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        		<h3>Olá Financeiro</h3>

        		<p>
        			O parceiro {{ $dadosVendedor->nome_vendedor }} efetuou a solicitação de pagamento das comissões dos seguintes orçamentos:
        		</p>
         		
         			
         		@if( empty($orcamentos))
		            	
		            <h4>Nenhum orçamento com pagamento concluido ainda.</h4>
		            <br>
		            <hr>

		    	@else

		    		<table width="100%">

		    			<thead>
		                    <tr>
		                        <th>Título</th>
		                        <th>Data finalizada</th>
		                        <th>Tipo de pagamento</th>
		                        <th>Data para pagamento</th>
		                        <th>Data pagamento</th>
		                        <th>Valor do pagamento</th>
		                    </tr>
		                </thead>
		                <tbody>

			    			@foreach($orcamentos as $orcamento)

			    				<tr>
			    					<td>
			    						{{ $orcamento['Titulo'] }}
			    					</td>
			    					<td>
			    						{{ $orcamento['Data_Finalizado'] }}
			    					</td>
			    					<td>
			    						{{ $orcamento['tipoPagamento'] }}
			    					</td>
			    					<td>
			    						{{ $orcamento['Data_Faturamento'] }}
			    					</td>
			    					<td>
			    						{{ $orcamento['Valor_Vencimento'] }}
			    					</td>
			    				</tr>

			    			@endforeach

			    		</tbody>

		    		</table>

		    	@endif

               
            </td>



        </tr>


    </table>

@endsection()