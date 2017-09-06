
@extends('layouts.main')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

            {{ Form::open(array('route'=> array('users.update', $usuario->id), 'method'=> 'PUT', 'class'=>'form')) }}

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
                        {{ Form::text('nomeCliente', $usuario->nome_usuario, array( 'id'=>'nomeCliente', 'class'=>'form-control', 'placeholder'=>'Nome do usuário')) }}
                        {{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}
                    </div>

                    <div class="form-group">
                        <label for="emailEnd">Email do usuário</label>
                        {{ Form::text('emailEnd', $usuario->email_usuario, array('id'=>'emailEnd', 'class'=>'form-control', 'placeholder'=>'Email do usuário')) }}
                        {{ $errors->first('emailEnd') }}
                    </div>

                    @if(Session::get('status') == 1)
                        <div class="form-group">
                            <label></label>
                            {{ Form::Label('status_usuario', 'Status de usuário') }}
                            <select class="form-control" name="status_usuario" id="status_usuario">
                                @foreach($statusUsuario->all() as $statusNovo)

                                    @if($statusNovo->id_status == $usuario->status)
                                        <option value="{{$statusNovo->id_status}}" selected="true">{{$statusNovo->status_usuario}}</option>
                                    @else
                                        <option value="{{$statusNovo->id_status}}">{{$statusNovo->status_usuario}}</option>
                                    @endif
                                  
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="senhaUsuario">Senha do usuário</label>
                        {{ Form::password('senhaUsuario', array( 'id'=>'senhaUsuario', 'class'=>'form-control', 'placeholder'=>'Senha')) }}
                        {{ $errors->first('senhaUsuario') }} 
                    </div>

                    <div class="form-group">
                        <label for="confirmaSenhaUsuario">Confirmação senha</label>
                        {{ Form::password('confirmaSenhaUsuario', array('id'=>'confirmaSenhaUsuario', 'class'=>'form-control', 'placeholder'=>'Confirmação da senha')) }}
                        {{ $errors->first('confirmaSenhaUsuario') }}
                    </div>

                     <div class="form-group">
                        {{ Form::submit('Atualizar', array('class'=>'btn btn-large btn-primary btn-block'))}}
                    </div>


                </div>

            {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection()
