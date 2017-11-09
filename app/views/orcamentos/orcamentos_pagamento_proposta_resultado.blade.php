@extends('layouts.email')

@section('content')


	<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="800" style="margin: auto;" class="email-container">


		<tr>

        	<td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

		    	<h3 class="page-header"> Pagamento da comissão do orçamento</h3>


        	</td>

       	</tr>


       	@if(!empty($resultado))

       		<tr>

        		<td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 18px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        			
        			<p>
        				Pagamento foi registrado com sucesso! 
        			</p>

        			<p>
        				Pode fechar está janela.
        			</p>

        		</td>

        	</tr>
       	@else

       		<tr>

        		<td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 18px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        			
        			<p>
        				Pagamento desta comissão já foi registrada.
        			</p>

        			<p>
        				Pode fechar está janela.
        			</p>

        		</td>

        	</tr>

       	@endif

	</table>
	


@endsection()