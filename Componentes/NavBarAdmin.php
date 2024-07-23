<nav class="navbar navbar-light fixed-top" style="background-color: var(--crema);">
        <div class="container-fluid mx-4">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fs-4 fw-bold" href="DashboardAdmin.php">
                <img src="../img/LogoLink.png" alt="logo" width="200">
            </a>
            <div class="dropdown">
                <a class="dropdown-toggle btn fw-bold" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                    $x = $_SESSION["codigo_usuario"];
                    $y = "SELECT a.nombre FROM administrador a WHERE a.codigo = '$x';";
                    $z = mysqli_query($cn, $y);
                    $w = mysqli_fetch_array($z);
                    echo $w["nombre"];
                    ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="../CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
            <div class="offcanvas offcanvas-start" style="background-color: var(--crema);" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                <a href="./DashboardAdmin.php" class="d-flex align-items-center mb-3">
                            <img src="../img/LogoLink.png" alt="logo" width="120px"> 
                        </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <nav class="nav flex-column">
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./DashboardAdmin.php">
                            <i class="bi bi-house me-2"></i> Principal
                        </a>
                        <hr>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Alumnos.php">
                            <i class="bi bi-person me-2"></i> Alumnos
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Empresas.php">
                            <i class="bi bi-building me-2"></i> Empresas
                        </a>                
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Docentes.php">
                            <i class="bi bi-mortarboard me-2"></i> Docentes
                        </a>
                        <hr>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Propuestas.php">
                            <i class="bi bi-file-earmark-text me-2"></i> Propuestas
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Proyectos.php">
                            <i class="bi bi-folder me-2"></i> Proyectos
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Reportes.php">
                            <i class="bi bi-graph-up me-2"></i> Reportes
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./Administradores.php">
                            <i class="bi bi-person-plus me-2"></i> Administradores
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./ContactoSoporte.php">
                            <i class="bi bi-question-circle me-2"></i> Contacto y Soporte
                        </a>
                        <a class="link-sobre nav-link d-flex align-items-center text-dark" href="./ElQueTodoLoVe.php"> 
                        <i class="bi bi-eye me-2"></i>Registros generales Auditoría
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>