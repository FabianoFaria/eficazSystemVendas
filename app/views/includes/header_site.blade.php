
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="" href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/logo-eficaz-system.png') }}" style="height: 80px; width: 200px;">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

              @if( Session::get('nome_atual'))
 
                @if( Session::get('status') == 'Admin') 

                  <ul class="nav navbar-nav navbar-right" style="margin: 10px;">
                   
                    <li><a href="#">Sobre</a></li>
                    <li><a href="#">Ajuda</a></li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-user">
                        <li>
                          <a href="{{ URL::to('/users/' . Session::get('id_atual')) }}"><i class="fa fa-user fa-fw"></i> Dados de usuário</a>
                        </li>
                        
                        <li class="divider"></li>

                        <li>
                          <a href="{{ url('/logout'); }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                      </ul>
                    </li>

                  </ul>

                @elseif(Session::get('status') == 'Parceiros')

                  <ul class="nav navbar-nav navbar-right" style="margin: 10px;">
                   
                    <li><a href="{{ url('/indicacoes'); }}">Indicações</a></li>
                    <li><a href="{{ url('/orcamentos'); }}">Orçamentos</a></li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-user">
                        <li>
                          <a href="{{ URL::to('/users/' . Session::get('id_atual')) }}"><i class="fa fa-user fa-fw"></i> Dados de usuário</a>
                        </li>
                        <li>
                          <a href="{{ URL::to('/enderecos/') }}"><i class="fa fa-list-alt fa-fw"></i> Endereço</a>
                        </li>

                        <li>
                          <a href="{{ URL::to('/telefones/') }}"><i class="fa fa-phone fa-fw"></i> Dados Contato</a>
                        </li>

                        <li>
                          <a href="{{ URL::to('/financas/') }}"><i class="fa fa-dollar fa-fw"></i> Dados financeiros</a>
                        </li>
                        <li class="divider"></li>

                        <li>
                          <a href="{{ url('/logout'); }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>

                      </ul>
                    </li>
                  </ul>

                @elseif(Session::get('status') == 'Cliente')

                  <ul class="nav navbar-nav navbar-right" style="margin: 10px;">
                   
                    <li><a href="#">Orçamentos</a></li>
                    <li><a href="#">Ajuda</a></li>
                  </ul>

                @endif

              @else
                 <ul class="nav navbar-nav navbar-right" style="margin: 10px;">
                  <li><a href="{{ URL::to('/login') }}">Entrar</a></li>
                  <li><a href="{{ URL::to('/registrar') }}" style="color:#ffffff;" class="btn btn-success">Cadastrar-se</a></li>
                  <li><a href="{{ URL::to('/sobre') }}">Sobre</a></li> 
                  <li><a href="{{ URL::to('/ajuda') }}">Ajuda</a></li>
                </ul>
              @endif

              <!-- <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
              </form> -->
            </div>
          </div>
        </nav>

        