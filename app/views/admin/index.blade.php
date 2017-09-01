

@extends('layouts.main')

@section('content')


	<div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Painel principal</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
        
        	@if(Session::has('nome_atual')) 

        	<h3 class="alert alert-info"> Bem vindo(a) : {{ Session::get('nome_atual') }}</h3> 
        	<!-- <p> Teste : {{ Session::get('id_atual') }}</p> 
        	<p> Teste : {{ Session::get('status') }}</p>  -->

        	@endif

        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Teste de contatos cadastrados
                    </div>
                    <div class="panel-body">
                            
                            @foreach($contatosClientes as $contatoCliente)


                                <p>{{ $contatoCliente['Nome_Fantasia'] }} - {{ $contatoCliente['Email'] }}</p>

                            @endforeach

                    </div>
                    <div class="panel-footer">
                            
                    </div>
                </div>
            </div>

        </div>
        

    </div>

	


@endsection()

