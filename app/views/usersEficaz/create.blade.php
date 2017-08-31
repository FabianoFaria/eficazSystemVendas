
@extends('layouts.main')

@section('content')
    
    <div id="page-wrapper">
    	{{ Form::open(array('route'=> 'users.store', 'class'=>'form-signup')) }}
            <h2 class="form-signup-heading">Cadastro de novo usuário.</h2>
         
           <!--  <ul>
                @foreach($statusUsuario->all() as $statusNovo)
                    <li>{{ $statusNovo->id_status }}</li>
                @endforeach
            </ul> -->

            <div class="row well">

                <div class="form-group">
                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
                    {{ Form::Label('nomeCliente', 'Nome do usuário') }}
                    {{ Form::text('nomeCliente', null, array( 'id'=>'nomeCliente', 'class'=>'form-control', 'placeholder'=>'Nome do usuário')) }}
                    {{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}
                </div>

                <div class="form-group">
                    <label for="emailEnd">Email do usuário</label>
                    {{ Form::text('emailEnd', null, array('id'=>'emailEnd', 'class'=>'form-control', 'placeholder'=>'Email do usuário')) }}
                    {{ $errors->first('emailEnd') }}
                </div>

                <div class="form-group">
                    <label></label>
                    {{ Form::Label('status_usuario', 'Status de usuário') }}
                    <select class="form-control" name="status_usuario" id="status_usuario">
                        @foreach($statusUsuario->all() as $statusNovo)
                          <option value="{{$statusNovo->id_status}}">{{$statusNovo->status_usuario}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="senhaNovoUsuario">Senha do usuário</label>
                    {{ Form::password('senhaNovoUsuario', array( 'id'=>'senhaNovoUsuario', 'class'=>'form-control', 'placeholder'=>'Senha')) }}
                    {{ $errors->first('senhaNovoUsuario') }}
                </div>

                <div class="form-group">
                    <label for="confirmaSenhaNovoUsuario">Confirmação da senha do usuário</label>
                    {{ Form::password('confirmaSenhaNovoUsuario', array('id'=>'confirmaSenhaNovoUsuario', 'class'=>'form-control', 'placeholder'=>'Confirmação da senha')) }}
                    {{ $errors->first('confirmaSenhaNovoUsuario') }}
                </div>

                 <div class="form-group">
                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
                </div>


            </div>

        {{ Form::close() }}
    </div>

@endsection()
