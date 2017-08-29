
@extends('layouts.login')

@section('content')

	{{ Form::open(array('route'=> 'users.store', 'class'=>'form-signup')) }}
        <h2 class="form-signup-heading">Cadastro de novo usuário.</h2>
     
        <ul>
        <!--     @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach -->
        </ul>

        <div class="row well">

            <div class="form-group">
                <!-- <label for="nomeCliente">Nome do usuário</label> -->
                {{ Form::Label('nomeCliente', 'Nome do usuário') }}
                {{ Form::text('nomeCliente', null, array( 'id'=>'nomeCliente', 'class'=>'input-block-level', 'placeholder'=>'Nome do usuário')) }}
                {{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}
            </div>

            <div class="form-group">
                <label for="emailEnd">Email do usuário</label>
                {{ Form::text('emailEnd', null, array('id'=>'emailEnd', 'class'=>'input-block-level', 'placeholder'=>'Email do usuário')) }}
                {{ $errors->first('emailEnd') }}
            </div>

            <div class="form-group">
                <label for="senhaNovoUsuario">Senha do usuário</label>
                {{ Form::password('senhaNovoUsuario', array( 'id'=>'senhaNovoUsuario', 'class'=>'input-block-level', 'placeholder'=>'Senha')) }}
                {{ $errors->first('senhaNovoUsuario') }}
            </div>

            <div class="form-group">
                <label for="confirmaSenhaNovoUsuario">Confirmação da senha do usuário</label>
                {{ Form::password('confirmaSenhaNovoUsuario', array('id'=>'confirmaSenhaNovoUsuario', 'class'=>'input-block-level', 'placeholder'=>'Confirmação da senha')) }}
                {{ $errors->first('confirmaSenhaNovoUsuario') }}
            </div>

             <div class="form-group">
                {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
            </div>


        </div>

    {{ Form::close() }}


@endsection()
