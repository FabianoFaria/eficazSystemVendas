

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
        

    </div>

	


@endsection()

