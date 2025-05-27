<!-- [ Inicio de la vista de "home" ] -->

<header id="home">

  <nav class="navbar navbar-expand-md navbar-dark top-nav-collapse default">
    <div class="container">
      <a class="navbar-brand" href="https://www.instagram.com/fastfoodthevina/">
        <img src="app/views/img/logo-the-vina-white.png" alt="logo" width="300px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item pe-1">
              <a target="_blank" href="https://www.instagram.com/fastfoodthevina/">
                <button type="button" class="btn btn-outline-warning d-inline-flex"><i class="ti ti-clipboard-list"></i>Menú</button>
              </a>
            </li>
            <li class="nav-item pe-1">
              <a target="_blank" href="https://api.whatsapp.com/send?phone=584122924087&text=Bienvenidos%20a%20THE%20VI%C3%91A%20la%20mejor%20comida%20rapida%20de%20Barquisimeto%2C%20indiquenos%20su%20nombre%20y%20su%20pedido%2C%20pronto%20seras%20atendido.%F0%9F%98%8E">
                <button type="button" class="btn btn-outline-success d-inline-flex"><i class="ti ti-brand-whatsapp"></i>Contáctanos</button>
              </a>
            </li>
            <li class="nav-item pe-1">
              <a target="_blank" href="https://maps.app.goo.gl/gFer86yrXHwuogB6A">
                <button type="button" class="btn btn-outline-primary d-inline-flex"><i class="ti ti-live-view"></i>Ubícanos</button>
              </a>
            </li>
          </ul>
      </div>
    </div>
  </nav>

  <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-9 col-xl-6">
          <h1 class="mt-sm-3 text-white mb-4 f-w-600 wow fadeInUp" data-wow-delay="0.2s">¡Bienvenido! <br>
            <span class="text-yellow-500 ">Te deseamos un feliz día</span>
          </h1>
          <h5 class="mb-4 text-white opacity-75 wow fadeInUp" data-wow-delay="0.4s">Disfruta de todas las funciones que este nuevo y novedoso sistema trae para ti</h5>
          <div class="my-5 wow fadeInUp" data-wow-delay="0.6s">
            <a href="<?php echo APP_URL ?>registrar-usuario" class="btn btn-outline-warning me-2"> <i class="ti ti-eye me-1"></i>Registrarse</a>
            <a href="<?php echo APP_URL ?>login" class="btn btn-warning"> <i class="ti ti-eye me-1"></i>Iniciar Sesión</a>
          </div>
        </div>
      </div>
    </div>

</header>

<!-- [ Fin de la vista de "home" ] -->