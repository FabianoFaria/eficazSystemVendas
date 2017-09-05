

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

        @if( ! empty($dadosVendedor))

            @if(empty($enderecos))
                <div class="row">
                    <div class="alert alert-danger">
                        <h4 class="text-center">Nenhum endereço cadastrado.</h4>
                        <a href="{{ url('/about'); }} ">
                            <h5 class="text-center"><i class="fa fa-list-alt "></i> Adicionar endereço.</h5>
                        </a>
                    </div>
                </div>
            @endif

            @if(empty($telefones))
                <div class="row">
                    <div class="alert alert-danger">
                    <h4 class="text-center">Nenhum telefone cadastrado.</h4>
                        <a href="{{ url('/about'); }} ">
                            <h5 class="text-center"><i class="fa fa-phone "></i> Adicionar telefone.</h5>
                        </a>
                    </div>
                </div>
            @endif


            <div class="row">


                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="text-center"> </h4>  
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-footer">
                                
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="text-center">Contatos Cadastrados</h4>  
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-footer">
                                
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="text-center"> </h4>  
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-footer">
                                
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="text-center">Endereços cadastrados</h4>  
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-footer">
                                
                        </div>
                    </div>
                </div>
            </div>

        @else

            <div class="row">

                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="text-center">Por favor complete seu cadastro.</h3>  
                        </div>
                        <div class="panel-body">
                                    
                            {{ Form::open(['route'=>'vendedores.store', 'class'=>'form-signin']) }}

                                {{ Form::hidden('id_usuario', Session::get('id_atual'), array('id' => 'id_usuario')) }}

                                <div class="form-group">
                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                                    {{ Form::Label('nomeCompleto', 'Nome do completo') }}
                                    {{ Form::text('nomeCompleto', null, array( 'id'=>'nomeCompleto', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
                                    {{ $errors->first('nomeCompleto', '<span class=inputError>:message</span>') }}
                                </div>

                                <div class="form-group">
                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                                    {{ Form::Label('nomeFantasia', 'Nome fantasia') }}
                                    {{ Form::text('nomeFantasia', null, array( 'id'=>'nomeFantasia', 'class'=>'form-control', 'placeholder'=>'Nome fantasia')) }}
                                    {{ $errors->first('nomeFantasia', '<span class=inputError>:message</span>') }}
                                </div>

                                <div class="form-group">
                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                                    {{ Form::Label('rgVendedor', 'R.G vendedor') }}
                                    {{ Form::text('rgVendedor', null, array( 'id'=>'rgVendedor', 'class'=>'form-control', 'placeholder'=>'R.G')) }}
                                    {{ $errors->first('rgVendedor', '<span class=inputError>:message</span>') }}
                                </div>

                                <div class="form-group">
                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                                    {{ Form::Label('cpfCnpj', 'CPF/CNPJ') }}
                                    {{ Form::text('cpfCnpj', null, array( 'id'=>'cpfCnpj', 'class'=>'form-control', 'placeholder'=>'CPF ou CNPJ')) }}
                                    {{ $errors->first('cpfCnpj', '<span class=inputError>:message</span>') }}
                                </div>


                                <div class="form-group">
                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                                    {{ Form::Label('generoVendedor', 'Gênero') }}
                                    
                                    {{ Form::radio('generoVendedor', '0', array('class'=>'form-control')) }} Feminino
                                    {{ Form::radio('generoVendedor', '1', array('class'=>'form-control')) }} Masculino

                                </div>

                                {{ Form::submit('Registrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
                            {{ Form::close() }}

                        </div>
                        <div class="panel-footer">
                                
                        </div>
                    </div>
                </div>

            </div>


        @endif
        

    </div>

	


@endsection()

