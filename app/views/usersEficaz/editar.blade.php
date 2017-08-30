
@extends('layouts.main')

@section('content')

    <div id="page-wrapper">

        {{ Form::open(array('route'=> array('users.update', $usuario->id), 'method'=> 'PUT', 'class'=>'form-signup')) }}

            <h2 class="form-signup-heading">Edição de dados do usuário</h2>
         
            <ul>
            <!--     @foreach($errors->all() as $error)
                    <li>{{ $usuario }}</li>
                @endforeach -->
            </ul>

            <div class="row well">

                <div class="form-group">

                    {{ Form::hidden('id_usuario', $usuario->id, array('id' => 'id_usuario')) }}

                    <!-- <label for="nomeCliente">Nome do usuário</label> --> 
                    {{ Form::Label('nomeCliente', 'Nome do usuário') }}
                    {{ Form::text('nomeCliente', $usuario->nome_usuario, array( 'id'=>'nomeCliente', 'class'=>'input-block-level', 'placeholder'=>'Nome do usuário')) }}
                    {{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}
                </div>

                <div class="form-group">
                    <label for="emailEnd">Email do usuário</label>
                    {{ Form::text('emailEnd', $usuario->email_usuario, array('id'=>'emailEnd', 'class'=>'input-block-level', 'placeholder'=>'Email do usuário')) }}
                    {{ $errors->first('emailEnd') }}
                </div>

                <div class="form-group">
                    <label for="senhaUsuario">Senha do usuário</label>
                    {{ Form::password('senhaUsuario', array( 'id'=>'senhaUsuario', 'class'=>'input-block-level', 'placeholder'=>'Senha')) }}
                    {{ $errors->first('senhaUsuario') }} 
                </div>

                <div class="form-group">
                    <label for="confirmaSenhaUsuario">Confirmação senha</label>
                    {{ Form::password('confirmaSenhaUsuario', array('id'=>'confirmaSenhaUsuario', 'class'=>'input-block-level', 'placeholder'=>'Confirmação da senha')) }}
                    {{ $errors->first('confirmaSenhaUsuario') }}
                </div>

                 <div class="form-group">
                    {{ Form::submit('Atualizar', array('class'=>'btn btn-large btn-primary btn-block'))}}
                </div>


            </div>

        {{ Form::close() }}

    </div>

@endsection()
