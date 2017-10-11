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


        		@if(! empty($financeiro))

        			<p>
        				Contas disponiveis para efetuar o pagamento.
        			</p>

        			@foreach($financeiro as $contas)

        				<p>
        					Banco : {{ $contas->nome_instituicao_bancaria }} Agência : {{ $contas->agencia }} Conta : {{ $contas->numero_conta }} Tipo conta : {{ $contas->tipo_conta }}
        				</p>

        			@endif

        		@endif
         		
         			
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
		                        <th>Registrar Pagamento</th>
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
			    						{{ number_format($orcamento['Valor_Vencimento'], 2) }}
			    					</td>
			    					<td>
			    						<a href="https://parcerias.eficazsystem.com.br/marcarComoPago/{{ $orcamento['Workflow_ID'] }}" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Registrar pagamento de comissão</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            			</a>
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