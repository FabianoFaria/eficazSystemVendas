@extends('layouts.email')

@section('content')


	<!-- Email Body : BEGIN -->
    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" style="margin: auto;" class="email-container">

		<!-- 1 Column Text : BEGIN -->
        <tr>
            <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
         			
                    Olá {{ $nomeUsuario }}, você acabou de se cadastrar no sistema de parcerias da Eficaz System, a partir de agora você poderá efetuar indicações de nossos serviços e receber suas comissões.
                    <br>
                    Acesse sua conta, complete seu cadastro e comece a indicar.

                <br><br>
                <!-- Button : Begin -->
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                        <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                            <a href="https://parcerias.eficazsystem.com.br/login" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Acessar conta</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </td>
                    </tr>
                </table>
                <!-- Button : END -->
            </td>
        </tr>	


    </table>

@endsection()

