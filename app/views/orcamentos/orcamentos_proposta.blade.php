@extends('layouts.email')

@section('content')

	<section class="features" id="features">
    	<div class="container">

	        <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="800" style="margin: auto;" class="email-container">

	         	<!-- 1 Column Text : BEGIN -->
        		<tr>

        			<td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

		    			<h3 class="page-header"> Detalhes para pagamento da comissão da proposta</h3>


        			</td>

        		</tr>

        		<tr>

        			<td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 18px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        				@if(! empty($proposta))

        					<p>
		        				Detalhes da proposta para efetuar pagamento.
		        			</p>


		        			<p>
		        				<b>Código do orçamento :</b> {{ $proposta['Workflow_ID'] }}
		        			</p>

		        			<p>

		        				<b>Título do orçamento :</b> {{ $proposta['Orc_titulo'] }} 

		        			</p>
		        			<p>
		        				@if($proposta['cliente_fantasia'] != "")
		        					
		        				<b>Cliente :</b>	{{ $proposta['cliente_fantasia'] }}

		        				@else

		        				<b>Cliente :</b>	{{ $proposta['cliente'] }}

		        				@endif


		        			</p>

		        			<!-- 

								/*

									"Proposta_ID": 520,
				        			"Workflow_ID": 303,
				        			"Titulo": "teste",
				        			"Data_Cadastro": "2017-10-27 10:16:45",
				        			"Usuario_Cadastro_ID": -1,
				        			"cliente": "Terezinha Polaca",
							        "cliente_fantasia": "",
							        "Parceiro_Origem_ID": 1,
							        "Usuario": "Administrador Geral",
							        "Quantidade_Total_Proposta": "13.00",
							        "Valor_Total_Proposta": "2045.0000",
							        "Total_Itens_Proposta": 2,
							        "Status_ID": 141,
							        "Status": "PROPOSTA APROVADA (FINALIZADA)",
							        "Situacao_ID": 113,
							        "Orc_titulo": "Teste de orcamento",
							        "Data_Finalizado": "2017-10-30 18:00:00",
							        "Tabela_Preco": "Tabela Padrão"

								*/

		        			-->

        				@endif

        			</td>

        		</tr>

        		<tr>

        			<td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 18px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        				@if(! empty($financeiroParc))

        					<p>
        						<b>Nome do parceiro :</b>{{ $nomeUsuario }}
        					</p>

		        			<p>
		        				Contas disponiveis para efetuar o pagamento.
		        			</p>

		        			<p>
		        				<b>Banco :</b> {{ $financeiroParc->nome_instituicao_bancaria }} <b>Agência :</b> {{ $financeiroParc->agencia }} <b>Conta :</b> {{ $financeiroParc->numero_conta }} <b>Tipo conta :</b> {{ $financeiroParc->tipo_conta }}
		        			</p>

		        			<p>
		        				<b>Total comissão a ser paga para o parceiro :</b> R$ {{ number_format($comissaoProposta, 2) }}
		        			</p>


		        		@endif

        			</td>

        		</tr>


        		<tr>

        			<td style="padding: 40px; text-align: left; font-family: sans-serif; font-size: 18px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        				{{ Form::open(array('route'=> 'OrcamentoController.registrarComissaoPaga', 'class'=>'form')) }}


        					{{ Form::hidden('id_orcamento', $proposta['Workflow_ID'], array('id' => 'id_orcamento')) }}

        					{{ Form::hidden('id_proposta', $proposta['Proposta_ID'], array('id' => 'id_proposta')) }}

        					{{ Form::hidden('id_parceiro', $proposta['Parceiro_Origem_ID'], array('id' => 'id_parceiro')) }}

        					{{ Form::hidden('total_comicao', $comissaoProposta, array('id' => 'total_comicao')) }}

        					<p>
        					{{ Form::Label('observacao', 'Observações') }}
        					{{ Form::text('observacao', null, array( 'id'=>'observacao', 'class'=>'form-control', 'placeholder'=>'Observação')) }}
        					</p>

        					{{ Form::submit('Registrar pagamento', array('class'=>'btn btn-large btn-primary btn-block'))}}

        					<p>
		        				<a href="{{ URL::to('/') }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
		        			</p>

        				{{ Form::close() }}

        			</td>

        		</tr>

	        </table>


		</div>
    </section>

@endsection()
