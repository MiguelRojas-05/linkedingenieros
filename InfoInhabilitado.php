<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal de Inhabilitación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/Min_Logo.png" ; type="image/x-icon" />
</head>
<body>

<!-- Botón para abrir el modal (opcional) -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inhabilitadoModal">Abrir Modal</button> -->

<!-- Modal -->
<div class="modal fade" id="inhabilitadoModal" tabindex="-1" aria-labelledby="inhabilitadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inhabilitadoModalLabel">Aviso de Inhabilitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Fuiste inhabilitado, contáctate con un administrador</h1>
            </div>
            <div class="modal-footer">
                <a href="Login.php" class="btn btn-secondary">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script para abrir el modal automáticamente -->
<script>
    $(document).ready(function(){
        $('#inhabilitadoModal').modal('show');
    });
</script>

</body>
</html>
