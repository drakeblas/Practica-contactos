<?php
    //Mando a llamar el código de otros archivos para utilizarlo aqui
    require("cabecera.php");
    require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de constactos</title>
    <!--Aqui mando a llamar lo que necesito para darle estilo a la pagina y funcionalidad-->
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script> <!--Queria implementerlo pero no me dio tiempo-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container">
     <!--TABLA DE CONTACTOS-->
    <h5>Todos los contactos</h5>
    <table class="striped display" id="tabla">
        <thead>
            <tr>
                <th><center>Fotografia</center></th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //Creo la conexion con la base de datos y ejecuto una consulta para rellenar la tabla automaticamente con un ciclo
                $database = new Conecta();
                $db=$database->open();
                $sql = $db->prepare("SELECT * FROM contactos"); 
                $sql->execute();
                while($fila = $sql->fetch()) {
                    // más codigo...     
            ?>
        <!--Se encuentran los botones eliminar y editar que nos mandan a otros con el id de la fila seleccionada-->
        <tr>
            <td><center><img src="<?php echo $fila['directorio'].$fila['img'];?>" style="width:90px;height:100px;"></center></td>
            <td><?php echo $fila['nombre'];?></td>
            <td><?php echo $fila['telefono'];?></td>
            <td><a href="editar_contacto?idContacto=<?php echo $fila['idContacto'];?>" class="btn-flat waves-effect btn"><i class="material-icons left">edit</i> Editar</a><a href="eliminar_contacto.php?idContacto=<?php echo $fila['idContacto'];?>" onclick="return confirmarEliminar()" class="btn-flat waves-effect btn red"><i class="material-icons">delete</i></a></td>
        </tr>
            <?php
            //cierra el while
            }
            ?>
    </tbody>    
    </table>
    <!--Simple boton de inicio-->
    <center>
        <a href="index" class="btn btn-flat btn-large "><i class="material-icons left">home</i>Inicio</a>
    </center>
    <br><br><br>
</div>
<!--Funcion que permite confirmar la eliminación al presionar el boton eliminar-->
<script type="text/javascript" >
    function confirmarEliminar(){
        var respuesta = confirm('¿Estas seguro que quieres borrar?');
        if(respuesta==true){
          return true;
        }else{
          return false;
        }
    }
</script> 
</body>
