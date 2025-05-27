<!-- [ Inicio de la segunda vista de "olvidar contraseña" ] -->
<div class="auth-main">
  <div class="auth-wrapper v3">
    <div class="auth-form">
      <div class="auth-header justify-content-center">
      <a href="https://www.instagram.com/fastfoodthevina/"><img src="app/views/img/logo-the-vina.png" alt="img" width="100"></a>
    </div>

      <form class="card my-2" action="<?php echo APP_URL ?>login">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-end mb-4">
            <h3 class="mb-0"><b>Restaurar contraseña</b></h3>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" placeholder="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Confirmar cambios</button>
          </div>

          <div class="saprator mt-3">
            <span>Regístrate con</span>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="d-grid">
                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                  <img src="app/views/img/google.svg" alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                </button>
              </div>
            </div>
            <div class="col-4">
              <div class="d-grid">
                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                  <img src="app/views/img/twitter.svg" alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                </button>
              </div>
            </div>
            <div class="col-4">
              <div class="d-grid">
                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                  <img src="app/views/img/facebook.svg" alt="img"> <span class="d-none d-sm-inline-block"> Facebook</span>
                </button>
              </div>
            </div>
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
              <li class="list-inline-item"><a href="#">Home</a></li>
              <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
              <li class="list-inline-item"><a href="#">Contact us</a></li>
            </ul>
          </div>
        <!-- </div> -->
      </div>

    </div>
  </div>
</div>
<!-- [ Fin de la segunda vista de "olvidar contraseña" ] -->