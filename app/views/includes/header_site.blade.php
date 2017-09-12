
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
              <ul class="nav navbar-nav navbar-right" style="margin: 10px;">
                <li><a href="{{ URL::to('/login') }}">Entrar</a></li>
                <li><a href="{{ URL::to('/registrar') }}" style="color:#ffffff;" class="btn btn-success">Cadastrar-se</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Ajuda</a></li>
              </ul>
              <!-- <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
              </form> -->
            </div>
          </div>
        </nav>

        