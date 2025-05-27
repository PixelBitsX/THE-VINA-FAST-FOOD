<!-- [ Inicio de la vista de "registrar usuario" ] -->
<div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header justify-content-center">
        <a href="https://www.instagram.com/fastfoodthevina/"><img src="app/views/img/logo-the-vina.png" alt="img" width="100"></a>
        </div>

        <form class="card my-2" action="<?php echo APP_URL ?>login">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Registro de usuario</b></h3>
              <a href="<?php echo APP_URL ?>login" class="link-primary">¿Ya tienes una cuenta?</a>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" class="form-control" placeholder="Pedro">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Apellido</label>
                  <input type="text" class="form-control" placeholder="Pérez">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Cédula</label>
                <input type="text" class="form-control" placeholder="12345678">
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Teléfono</label>
                  <input type="email" class="form-control" placeholder="04160000000">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" placeholder="ejemplo@gmail.com">
              </div>
            </div>

              <!--Grupo Usuario-->
              <label class="form-label">Usuario</label>
              <div class="input-group mb-3">
                <i class="ph-duotone ph-user input-group-text"></i>
                <input type="text" class="form-control" placeholder="Ejemplo123">
              </div>

            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control">
              </div>
            </div>

            <div class="d-grid mt-3">
              <button type="submit" class="btn btn-primary">Crear cuenta</button>
              <button type="reset" class="btn btn-light">Limpiar</button>
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
              <p class="m-0">Copyright © <a href="#">Anderson Freitez Company</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Inicio</a> | </li>
                <li class="list-inline-item"><a href="#">Política de Privacidad</a> | </li>
                <li class="list-inline-item"><a href="#">Contáctanos</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>

      </div>
    </div>
  </div>
<!-- [ Fin de la vista de "registrar usuario" ] -->