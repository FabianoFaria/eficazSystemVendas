
@extends('layouts.main_site')

@section('content')


  <section class="cta header_capa">
    <div class="cta-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="" style="color:#ffffff;">Procurando uma fonte de renda extra? <!-- Seja nosso parceiro e fature suas comissões por indicações! -->
              Seja nosso parceiro, faça indicações e ganhe comissões.</h1>
              <a href="#saibaMais" class="btn btn-outline btn-xl js-scroll-trigger">Comece agora!</a>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            
              <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
             <!--  <img src="{{ URL::asset('img/acordo_negocio.jpg') }}" class="img-fluid" alt="" style="max-width: 100%;height: 100%;"> -->

          </div>
        </div>
      </div>
    </div>
    <div class="overlay"></div>
  </section>


<section class="download bg-primary text-center" id="saibaMais">
    <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <h2 class="section-heading">Saiba mais sobre nosso sistema de parceria!</h2>
            <!-- <p>Através de indicações, consiga uma renda extra com as comissões!</p> -->
            <!-- <div class="badges">
              <a class="badge-link" href="#"><img src="{{ URL::asset('img/google-play-badge.svg') }}" alt=""></a>
              <a class="badge-link" href="#"><img src="{{ URL::asset('img/app-store-badge.svg') }} " alt=""></a>
            </div> -->
          </div>             

          <div class="col-md-6 mx-auto">
            <ul class="lista-descricao">

              <li>Indique os serviços da Eficaz System.</li>
              <li>Cadastre sua indicação.</li>
              <li>Acompanhe a situação de sua indicação.</li>
              <li>Se sua indicação fechar négocio, é gerado um orçamento.</li>
              <li>Com a conclusão do orçamento o serviço é entregue a sua indicação.</li>
              <li>Após o pagamento do serviço, é contabilizado um valor de comissão.</li>
              <li>A comissão é paga a você.</li>

            </ul>

          </div>
        </div>
    </div>
</section>

<section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Ao se tornar um parceiro, quais as vantagens?</h2>
          <p class="text-muted">Confira algumas vantagens com a parceria da Eficaz System.</p>
          <hr>
        </div>
        <div class="row">
         
          <div class="col-lg-12 my-auto">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-clock text-primary"></i>
                    <h3>Faça seu horário</h3>
                    <p class="text-muted">Faça suas indicações quando achar mais apropriado!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-map text-primary"></i>
                    <h3>De qualquer lugar</h3>
                    <p class="text-muted">Possibilidade de efetuar indicações da sua própria casa!</p>
                  </div>
                </div>
               <!--  <div class="col-lg-4">
                  <div class="feature-item">
                    <i class="icon-vector text-primary"></i>
                    <h3>De qualquer lugar</h3>
                    <p class="text-muted">Possibilidade de efetuar indicações da sua própria casa!</p>
                  </div>
                </div> -->

              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-people text-primary"></i>
                    <h3>Acompanhe suas indicações</h3>
                    <p class="text-muted">Tenha acesso ao resultado de suas indicações!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-wallet text-primary"></i>
                    <h3>Monitore seus ganhos</h3>
                    <p class="text-muted">Acompanhe a situação da comissão de suas indicações!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>Pronto para ser um parceiro?<br>Comece agora!</h2>
          <a href="{{ URL::to('/registrar') }}" class="btn btn-outline btn-xl js-scroll-trigger">Cadastre-se!</a>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact bg-primary" id="contact">
      <div class="container">
        <h2>Acompanhe nossos passos!</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-instagram">
            <a href="{{ URL::to('https://www.instagram.com/eficazsystem/') }}" target="_blank" >
              <i class="fa fa-instagram"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="{{ URL::to('https://www.facebook.com/EficazSystem/') }}" target="_blank">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item social-linkedin">
            <a href="{{ URL::to('https://www.linkedin.com/company/24784474/') }}" target="_blank">
              <i class="fa fa-linkedin"></i>
            </a>
          </li>
        </ul>
      </div>
    </section>


@endsection()
