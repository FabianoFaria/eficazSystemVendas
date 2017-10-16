@extends('layouts.email')

@section('content')

	
	<!-- Email Body : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" style="margin: auto;" class="email-container">

    	<!-- 1 Column Text : BEGIN -->
        <tr>

        	<td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">

        		<p>
        			Olá parceiro, este email foi enviado para que você possa alterar sua senha de acesso ao sistema.
        		</p>
        		<p>
        			Se você não solicitou a mudança de email, favor ignorar este email.
        		</p>
              	<p>
              		Caso queira trocar a sua senha, acesse o link disponivel abaixo:
              	</p>

        		<br><br>

        		 <!-- Button : Begin -->
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                        <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                            <a href="{{ URL::to('redefinirSenha', array($token)) }}" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Alterar senha</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </td>
                    </tr>
                </table>
                <!-- Button : END -->

                <p>
        			Este link irá expirar em {{ Config::get('auth.reminder.expire', 60) }} minutos.
        		</p>

        	</td>


        </tr>

	</table>

@endsection()