@extends('layouts.main')

@section('content')

	<div id="page-wrapper">


		<h2 class="form-signup-heading">Dados de usuário</h2>


		 <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    	Nome do usuário : {{ $usuario->nome_usuario }}
                    </div>
                    <div class="panel-body">
                         
                    	<p>Email : {{ $usuario->email_usuario }}</p>

                    	<p>Ativo desde : {{ $ativo_desde }}</p>

                    </div>
                    <div class="panel-footer">
                          
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>


	</div>

@endsection()