<nav class="navbar navbar-light fixed-top" style="background-color: var(--crema);">
    <div class="container-fluid mx-4">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand  fs-4 fw-bold" href="IndexDocente.php">
            <img src="../img/LogoLink.png" alt="logo" width="200">
        </a>
        <div class="dropdown">
            <a class="dropdown-toggle btn fw-bold" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                $x = $_SESSION["codigo_usuario"];
                $y = "SELECT d.nombre FROM docente d WHERE d.codigo = '$x';";
                $z = mysqli_query($cn, $y);
                $w = mysqli_fetch_array($z);
                echo $w["nombre"];
                
                ?> </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../CerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
        <div class="offcanvas offcanvas-start" style="background-color: var(--crema);" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Opciones</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="IndexDocente.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Actualizar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="FotoPerfilDocente.php">Foto de perfil</a></li>
                            <li><a class="dropdown-item" href="ActualizarPerfilDocente.php">Datos personales</a></li>
                            <li><a class="dropdown-item" href="ActualizarPasswordDocente.php">Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="VerTalentos.php">Talentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="VerPropuestasDocente.php">Propuestas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="VerProyectos.php">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ContactarAdmin.php">
                            Contáctenos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>