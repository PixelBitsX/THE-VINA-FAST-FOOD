<!-- [ Header Topbar ] start -->
<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
    <ul class="list-unstyled">
        <!-- ======= Menu collapse Icon ===== -->
        <li class="pc-h-item pc-sidebar-collapse">
        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
        </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
        </a>
        </li>
        <li class="dropdown pc-h-item d-inline-flex d-md-none">
        <a
            class="pc-head-link dropdown-toggle arrow-none m-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
        >
            <i class="ti ti-search"></i>
        </a>
        <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3">
            <div class="form-group mb-0 d-flex align-items-center">
                <i data-feather="search"></i>
                <input type="search" class="form-control border-0 shadow-none" placeholder="Busca aquí. . .">
            </div>
            </form>
        </div>
        </li>
        <li class="pc-h-item d-none d-md-inline-flex">
        <form class="header-search">
            <i data-feather="search" class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Busca aquí. . .">
        </form>
        </li>
    </ul>
    </div>
    <!-- [Mobile Media Block end] -->
    <div class="ms-auto">
    <ul class="list-unstyled">

        <li class="dropdown pc-h-item header-user-profile">
        <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            data-bs-auto-close="outside"
            aria-expanded="false"
        >

        <?php 
            if(is_file("app/views/fotos/".$_SESSION['foto'])){
                $perfil1='<img src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'" alt="foto 1" class="user-avtar">';
                $perfil2='<a href="'.APP_URL.'actualizar-usuario-foto/'.$_SESSION['id'].'"><img src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'" alt="foto 1" class="user-avtar wid-35"></a> ';
            }else{
                $perfil1='<img src="'.APP_URL.'app/views/fotos/default.png" alt="foto perfil" class="user-avtar">';
                $perfil2='<a href="'.APP_URL.'actualizar-usuario-foto/'.$_SESSION['id'].'"><img src="'.APP_URL.'app/views/fotos/default.png" alt="foto 1" class="user-avtar wid-35"></a> ';
            }
        ?>
            <?php echo $perfil1 ?>
            <span><?php echo $_SESSION['usuario'] ?></span>
        </a>
        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
            <div class="d-flex mb-1">
                <div class="flex-shrink-0">
                <?php ?>
                <?php echo $perfil2; ?>
                </div>
                <div class="flex-grow-1 ms-3">
                <h6 class="mb-1"><?php echo $_SESSION['nombre']." ". $_SESSION['apellido'] ?></h6>
                <span>Desarrollador</span>
                </div>
                <a href=" <?php echo APP_URL ?>logOut" class="cerrar_sesion pc-head-link bg-transparent" data-bs-toggle="tooltip" title="Cerrar sesión"><i class="ti ti-power text-danger"></i></a>
            </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                class="nav-link active"
                id="drp-t1"
                data-bs-toggle="tab"
                data-bs-target="#drp-tab-1"
                type="button"
                role="tab"
                aria-controls="drp-tab-1"
                aria-selected="true"
                ><i class="ti ti-user"></i> Perfil</button
                >
            </li>
            <li class="nav-item" role="presentation">
                <button
                class="nav-link"
                id="drp-t2"
                data-bs-toggle="tab"
                data-bs-target="#drp-tab-2"
                type="button"
                role="tab"
                aria-controls="drp-tab-2"
                aria-selected="false"
                ><i class="ti ti-settings"></i>Configuraciones</button
                >
            </li>
            </ul>
            <div class="tab-content" id="mysrpTabContent">
            <div class="tab-pane fade show active" id="drp-tab-1" >
                <a href="<?php echo APP_URL ?>actualizar-usuario/<?php echo $_SESSION['id'] ?>" class="dropdown-item">
                <i class="ti ti-edit-circle"></i>
                <span>Editar Perfil</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ti ti-user"></i>
                <span>Ver Perfil</span>
                </a>
                <a href="<?php APP_URL ?>logOut" class="cerrar_sesion dropdown-item">
                <i class="ti ti-power"></i>
                <span>Cerrar Sesión</span>
                </a>
            </div>
            <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                <a href="#!" class="dropdown-item">
                <i class="ti ti-help"></i>
                <span>Soporte Técnico</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ti ti-lock"></i>
                <span>Política de Privacidad</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ti ti-messages"></i>
                <span>Mensajes para el administrador</span>
                </a>
                </a>
            </div>
            </div>
        </div>
        </li>
    </ul>
    </div>
    </div>
</header>
<!-- [ Header ] end -->