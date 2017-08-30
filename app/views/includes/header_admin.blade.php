

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/logo-eficaz-system.png') }}" style="height: 80px; width: 200px;">
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>

                    @if(Session::has('nome_atual'))
                
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ URL::to('/users/' . Session::get('id_atual')) }}"><i class="fa fa-user fa-fw"></i> Dados de usuário</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('/users/' . Session::get('id_atual') .'/edit') }}"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout'); }}"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                            </li>
                        </ul>

                    @endif

                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <!-- MENU LATERAL -->
             <div class="navbar-default sidebar" role="navigation">
                <!-- /.sidebar-collapse -->
                <div class="sidebar-nav navbar-collapse">
                    
                    <ul class="nav" id="side-menu">

                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ URL::to('/') }}"><i class="fa fa-dashboard fa-fw"></i> Página principal</a>
                        </li>

                        <!-- EFETUADO A VERIFICAÇÃO DE TIPO DE PERFIL DE USUÁRIO -->
                        @if(Session::get('status') == 1)
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ URL::to('/users/create') }}">Adicionar novo</a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('/users') }}">Listar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        @else
                            <li>
                                <a href="tables.html"><i class="fa fa-table fa-fw"></i> Vendas</a>
                            </li>
                            <li>
                                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Orçamento</a>
                            </li>
                        @endif

                    </ul>

                </div>


                

            </div>
            <!-- /.navbar-static-side -->

        </nav>

        