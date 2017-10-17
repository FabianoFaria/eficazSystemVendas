@extends('layouts.main_site')

@section('content')

	<section class="features" id="">

		<div class="container">

			<div class="container">

				<h3 class="text-center">Dúvidas e questões pertinentes sobre a parceria com a <img src="https://parcerias.eficazsystem.com.br/img/logo-eficaz-system.png" width="200" height="75" alt="Eficaz System" border="0"></h3>

				<p class="text-center text-muted">
					<!-- A Eficaz System oferece um sistema de parceria para que você possa divulgar os serviços que nossa empresa entrega com qualidade e dedicação enquanto você pode ganhar uma boa comissão. -->

					Principais dúvidas e questões sobre como funciona nosso sistema de parcerias.
				</p>

			</div>

		</div>

		<div class="container">

			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

				<div class="panel panel-default">

					<div class="panel-heading" role="tab" id="headingOne">

						<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					        	Como posso participar?
					        </a>
					    </h4>

					</div>

					<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">

						<div class="panel-body">
							
							<p>
								Basta efetuar o cadastro neste site, assim que todas as informações forem completadas o usuário podera começar a efetivamente divulgar os serviços da Eficaz System.
							</p>

						</div>

					</div>

				</div>


				<div class="panel panel-default">

					<div class="panel-heading" role="tab" id="headingDois">

						<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDois" aria-expanded="true" aria-controls="collapseOne">
					        	Qual o valor das comissões?
					        </a>
					    </h4>

					</div>

					<div id="collapseDois" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDois">

						<div class="panel-body">

							<p>
								Os valores das comissões irão variar conforme o valor do serviço que foi prestado ao cliente que foi indicado. Sendo assim, quanto maior o serviço indicado para o cliente, maior será o valor da comisão.
							</p>

						</div>

					</div>

				</div>

				<div class="panel panel-default">

					<div class="panel-heading" role="tab" id="headingTres">

						<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTres" aria-expanded="true" aria-controls="collapseOne">
					        	Quais os serviços podem ser oferecidos?
					        </a>
					    </h4>

					</div>

					<div id="collapseTres" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTres">

						<div class="panel-body">

							<p>
								Os serviços que podem ser oferecidos pelos parceiros são os mesmo serviços que a Eficaz System oferece aos clientes.
							</p>
						</div>

					</div>

				</div>

				<div class="panel panel-default">

					<div class="panel-heading" role="tab" id="headingQuatro">

						<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseQuatro" aria-expanded="true" aria-controls="collapseOne">
					        	Há limite ou meta a ser atingido?
					        </a>
					    </h4>

					</div>

					<div id="collapseQuatro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingQuatro">

						<div class="panel-body">

							<p>
								Não nenhum limite ou meta a ser batida, o própio parceiro pode definir o ritmo e a quantidade de indicações que irá fazer enquanto estiver fazendo parte do programa de parceria com a Eficaz System.
							</p>

						</div>

					</div>

				</div>

				<div class="panel panel-default">

					<div class="panel-heading" role="tab" id="headingCinco">

						<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCinco" aria-expanded="true" aria-controls="collapseOne">
					        	Como é efetuado o pagamento?
					        </a>
					    </h4>

					</div>

					<div id="collapseCinco" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCinco">

						<div class="panel-body">

							<p>
								Após a entrega e a cobrança do serviço ao cliente, a comissão será contabilizada para o parceiro que poderá solicitar o pagamento, que poderá ser feito na conta que foi informada durante o cadastro.
							</p>

						</div>

					</div>

				</div>

			</div>

			<p class="text-center text-muted">

				Em caso de dúvidas mais especificas, basta entrar em contato com a Eficaz System para saber mais informações.

			</p>

		</div>

	</section>

@endsection()