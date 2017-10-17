@extends('layouts.main_site')

@section('content')

	<section class="features" id="">

		<div class="container">

			<h3 class="text-center">Sobre o sistema de parcerias da <img src="https://parcerias.eficazsystem.com.br/img/logo-eficaz-system.png" width="200" height="75" alt="Eficaz System" border="0"></h3>

			<p class="text-center text-muted">
				<!-- A Eficaz System oferece um sistema de parceria para que você possa divulgar os serviços que nossa empresa entrega com qualidade e dedicação enquanto você pode ganhar uma boa comissão. -->

				Para você ganhar uma boa comissão enquanto divulga nossos produtos e serviços ao seus contatos.
			</p>

		</div>

		<hr>
		
		<div class="container">

			<div class="row">

				<div class="col-md-6">
					<h3>
						A Eficaz Sistem
					</h3>

					<p>
						<!-- A empresa Eficaz System oferece serviços e produtos referentes a mantenção ou venda de equiapemntos para no-breaks e bancos de baterias. -->
						A empresa Eficaz System oferece um sistema de parcerias para quem se oferecer para divulgar e indicar os serviços para potenciais clientes.
					</p>
				</div>

				<div class="col-md-6">
					<h3>
						Os serviços ofertados
					</h3>
					<p>
						Os serviços oferecidos constituem em manutenção, backup ou atualização de no-breaks, instalações ou trocas de banco de baterias para no-breaks, monitoramento de no-breaks e demais serviços que podem ser verificados no site da <a href="https://eficazsystem.com.br/" target="blank">Eficaz System</a>
					</p>
				</div>

			</div>

			<div class="row">

				<div class="col-md-6">
					<h3>
						A relação com o parceiro
					</h3>
					<p>
						Ao se cadastrar no sistema de parcerias, o usuário passa a se tornar parceiro da Eficaz system, 
						o parceiro pode então efetuar a divulgação de serviços e produtos oferecidos pela Eficaz System, não sendo obrigatorio o cumprimento de metas ou limites minimos de divulgação.
					</p>
				</div>

				<div class="col-md-6">
					<h3>
						As comissões
					</h3>
					<p>
						O usuário que efetuar a divulgação de serviços e produtos da Eficaz System que resultar em indicações que gerem rendimentos para a empresa, terá automaticamente direito a receber uma comissão de acordo com o valor do serviço que foi contratado.
					</p>
				</div>

			</div>
			
		</div>

		<hr>

		<div class="container">

			<h3 class="text-center">Siga a Eficaz System!</h3>

			<div class="row">
				
				<div class="col-md-4 col-md-offset-4">

					
						<a href="{{ URL::to('https://www.instagram.com/eficazsystem/') }}" target="_blank" class="btn btn-block btn-social btn-instagram" style="padding:7px 12px;">
			            	<i class="fa fa-instagram" style="position:relative;"></i>Seguir pelo instagram
			        	</a>
					
			        	<a href="{{ URL::to('https://www.facebook.com/EficazSystem/') }}" target="_blank" class="btn btn-block btn-social btn-facebook" style="padding:7px 12px;">
			            	<i class="fa fa-facebook" style="position:relative;"></i>Seguir pelo facebook
			        	</a>
			        	<a href="{{ URL::to('https://www.linkedin.com/company/24784474/') }}" target="_blank" class="btn btn-block btn-social btn-linkedin" style="padding:7px 12px;">
			            	<i class="fa fa-linkedin" style="position:relative;"></i>Seguir pelo linkedin
			        	</a>
				</div>

			</div>

		</div>

		<hr>

	</section>

@endsection()