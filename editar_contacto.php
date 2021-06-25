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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/validacion.js"></script>
        <?php
            include_once("cabecera.php");
            include_once("conexion.php");
            //Al hacer click en editar mando el id aqui y con él se ejecuta una consulta que me permita rellenar los datos del id elegido
			if(isset($_GET['idContacto'])){
				$database = new Conecta();
				$db = $database->open();
				$query = $db->prepare("SELECT * FROM contactos WHERE idContacto = ?");
				$query->bindParam(1, $_GET['idContacto']);
				$query->execute();
				$contacto = $query->fetch();

				$database->close();
            }
        ?>

    <div class="container">
        <div class="row">
            <h3>Editar contactos</h3>
        </div>
        <!-- FORMULARIO DE EDICION-->
        <!-- Llamo la función de validacion al presionar el boton de agregar con onsubmit -->
        <form action="" class="col s12" enctype="multipart/form-data"  method="POST" onsubmit="return validacionRegistro()">
            <div class="row">
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="nombre" name="nombre" type="text" value="<?php echo $contacto['nombre'];?>">
                    <label class="active" for="nombre">Nombre</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="apellidoP" name="apellidoP" type="text" value="<?php echo $contacto['apPaterno'];?>">
                    <label class="active" for="apellidoP">Apellido Paterno</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="apellidoM" name="apellidoM" type="text" value="<?php echo $contacto['apMaterno'];?>">
                    <label class="active" for="apellidoM">Apellido Materno</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">contact_phone</i>
                    <input id="telefono" name="telefono" type="tel" value="<?php echo $contacto['telefono'];?>">
                    <label class="active" for="telefono">Telefono</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">email</i>
                    <input id="correo" name="correo" type="text" value="<?php echo $contacto['correo'];?>">
                    <label class="active" for="correo">Correo</label>
                </div>
                <div class="file-field input-field col s4">
                    <div class="btn" >
                        <span><i class="material-icons">add_a_photo</i></span>
                        <input id="foto"name="foto" type="file" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Sube tu fotografía">
                    </div>
                </div>
            </div>    
            <center>
            <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
            <button class="btn-flat btn-large waves-effect " type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
            <button class="btn btn-large waves-effect" name="editar" type="submit"><i class="material-icons right">create</i>Editar</button>
            </center>
        </form>
    </div>

    <?php
    //Valida que haya algo dentro del formulario
    if(isset($_POST['editar'])){
        $filetemp= $_FILES['foto']['tmp_name'];
        $nomb_foto = $_FILES['foto']['name'];
        $destino=$_SERVER['DOCUMENT_ROOT'].'/practica-contactos/img/';
        $filetype = $_FILES['foto']['type'];

        //Se crea la conexión y se utiliza la instrucción update para actualizar
        $db = $database->open();
        $editar = $db->prepare("UPDATE contactos SET nombre=?, apPaterno=?, apMaterno=?, telefono=?, correo=?, img=? where idContacto=?;
        ");
        $editar->bindParam(1, $_POST['nombre']);
        $editar->bindParam(2, $_POST['apellidoP']);
        $editar->bindParam(3, $_POST['apellidoM']);
        $editar->bindParam(4, $_POST['telefono']);
        $editar->bindParam(5, $_POST['correo']);
        $editar->bindParam(6, $nomb_foto);
        $editar->bindParam(7, $_GET['idContacto']);
        if($editar->execute()){
            try{ 
                move_uploaded_file($filetemp, $destino.$nomb_foto);
            }catch(Exception $e){
                echo $e->getMessage();
            }
            //Mensaje de exito y redirecciona a la lista de contactos
            echo "<script>alert('Se actualizó correctamente')</script>";
            echo "<script>window.location='lista_contacto.php'</script>";
        } else {
            //mensaje de error
            echo "<script>alert('Problema al actualizar";

        }
	}
    ?>
   
</body>


</html>