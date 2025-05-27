<!-- [ Inicio de la primera vista de "olvidar contraseña" ] -->
<div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header justify-content-center">
        <a href="https://www.instagram.com/fastfoodthevina/"><img src="app/views/img/logo-the-vina.png" alt="img" width="100"></a>
        </div>

        <form class="card my-2" action="<?php echo APP_URL ?>olvidar-contrasena-2">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Recuperar contraseña</b></h3>
              <a href="<?php echo APP_URL ?>login" class="link-primary">Regresar</a>
            </div>

            <p class="text-muted">Por favor introduzca su correo electrónico</p>

            <div class="form-group mb-3">
              <label class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" placeholder="ejemplo@gmail.com">
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">Solicitar código</button>
            </div>
          </div>
        </form>
        
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Inicio</a> | </li>
                <li class="list-inline-item"><a href="#">Politica de Privacidad</a> | </li>
                <li class="list-inline-item"><a href="#">Contáctanos</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>

      <!--Footer-->
      </div>
    </div>
  </div>
<!-- [ Fin de la segunda vista de "olvidar contraseña" ] -->
