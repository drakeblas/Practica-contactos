<?php
    require("cabecera.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactos</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row center">
        <h5>Administración de contactos</h5>
    </div>
</div>
<!-- Hice una simple interfaz administrativa-->
<div class="container center">
    <div class="row center">
    <div class="col s3"><span></span></div>
        <a href="registro_contacto">
            <div class="col s3"  id="registro">
                <div class="card-panel grey lighten-2 hoverable">
                    <span class="black-text">
                        <i class="material-icons fixed medium">add_box</i>
                        <p>Registrar</p>
                    </span>
                </div>
            </div>
        </a> 
        <a href="lista_contacto">
            <div class="col s3 " id="lista_contactos">
                <div class="card-panel grey lighten-2 hoverable">
                    <span class="black-text">
                        <i class="material-icons fixed medium">contacts</i>
                        <p>Lista de contactos</p>
                    </span>
                </div>
            </div>
        </a>
        <div class="col s3"><span></span></div>
    </div>
</div>
</body>
<!-- SCRIPTS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/materialize.min.js"></script>


</html>