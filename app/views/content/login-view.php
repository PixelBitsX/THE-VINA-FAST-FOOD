<!-- [ Inicio de la vista de "login" ] -->
<div class="auth-main">
<div class="auth-wrapper v3">
<div class="auth-form">
    <div class="auth-header justify-content-center">
    <a href="https://www.instagram.com/fastfoodthevina/"><img src="app/views/img/logo-the-vina.png" alt="img" width="100"></a>
    </div>
    
    <form class="card my-2" action="" method="POST" autocomplete="off">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
            <h3 class="mb-0"><b>Iniciar Sesión</b></h3>
            <a href="<?php echo APP_URL ?>registrar-usuario" class="link-primary">¿No tienes una cuenta?</a>
            </div>

        <!--Grupo Usuario-->
        <label class="form-label">Usuario</label>
        <div class="input-group mb-3">
        <i class="ph-duotone ph-user input-group-text"></i>
        <input type="text" name="login_usuario" class="form-control" placeholder="Ejemplo123">
        </div>

        <!--Grupo Contraseña-->
        <label class="form-label">Contraseña</label>
        <div class="input-group mb-3">
        <i class="ti ti-lock-open input-group-text"></i>
        <input type="password" name="login_contrasena" class="form-control" placeholder="">
        </div>

            <div class="d-flex mt-1 justify-content-between">
            <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted" for="customCheckc1">Recuérdame</label>
            </div>
            <a href="<?php echo APP_URL ?>olvidar-contrasena-1" class="link-primary">¿Olvidó su contraseña?</a>
            </div>
            <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
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
            <p class="m-0">AndersonFreitez © <a href="#">Company</a></p>
            </div>
            <div class="col-auto my-1">
            <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="<?php echo APP_URL ?>home">Inicio |</a></li>
                <li class="list-inline-item"><a href="#">Política de privacidad | </a></li>
                <li class="list-inline-item"><a href="<?php echo APP_URL ?>contactanos">Contáctanos</a></li>
            </ul>
            </div>
        <!-- </div> -->
         

    </div>
</div>
</div>
</div>
<!-- [ Fin de la vista de "login" ] -->

