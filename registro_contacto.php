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
        include("cabecera.php");
        include_once("conexion.php");
    ?>
    <div class="container">
        <div class="row">
            <h3>Agregar contactos</h3>
        </div>
        <!-- Llama la función de validacion al presionar el boton de agregar con onsubmit -->
        <form action="" class="col s12" enctype="multipart/form-data"  method="POST" onsubmit="return validacionRegistro()">
            <div class="row">
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="nombre" name="nombre" type="text">
                    <label class="active" for="nombre">Nombre</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="apellidoP" name="apellidoP" type="text">
                    <label class="active" for="apellidoP">Apellido Paterno</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">person</i>
                    <input id="apellidoM" name="apellidoM" type="text">
                    <label class="active" for="apellidoM">Apellido Materno</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">contact_phone</i>
                    <input id="telefono" name="telefono" type="tel">
                    <label class="active" for="telefono">Telefono</label>
                </div>
                <div class="input-field col s4">
                    <i class="material-icons prefix">email</i>
                    <input id="correo" name="correo" type="text">
                    <label class="active" for="correo">Correo</label>
                </div>
                <div class="file-field input-field col s4">
                    <div class="btn" >
                        <span><i class="material-icons">add_a_photo</i></span>
                        <input id="foto"name="foto" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Sube tu fotografía">
                    </div>
                </div>
            </div>    
            <center>
            <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
            <button class="btn-flat btn-large waves-effect " type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
            <button class="btn btn-large waves-effect" name="add" type="submit"><i class="material-icons right">add</i>Agregar</button>
            </center>
        </form>
    </div>

    <?php
        //Se crea la conexión
        $database = new Conecta();
        $db = $database->open();
        //Valida que haya algo dentro del formulario 
        if(isset($_POST['add'])){
            //Consultas que compara el correo escrito en el formulario con los de la base de datos para que pueda ingresarse, mediante el arreglo
            $query=$db->prepare("SELECT correo from contactos WHERE correo = :correo");
            $query->execute(array(":correo"=>$_POST['correo']));
            $rows = $query->fetch();
            if($rows){
                //Imprime un mensaje
                echo '<script>window.alert("El correo electrónico ya fue registrado")</script>';
             }else if(!$rows){
            $query=$db->prepare("SELECT telefono from contactos WHERE telefono = :telefono");
            $query->execute(array(":telefono"=>$_POST['telefono']));
            $rows = $query->fetch();
            }if($rows){
                //Imprime un mensaje
                echo '<script>window.alert("El numero de telefono ya fue registrado")</script>';
            }else{
            //Puedo extraer la imagen del directorio que sea y especifico la ruta que tendrá
            $filetemp= $_FILES['foto']['tmp_name'];
            $nomb_foto = $_FILES['foto']['name'];
            $destino=$_SERVER['DOCUMENT_ROOT'].'/practica-contactos/img/';
            $filetype = $_FILES['foto']['type'];
            //Utilizo una instrucción SQL para insertar mediante bindParam y adquiero la información del formulario mediante el metodo POST
            $sql = $db->prepare("INSERT INTO contactos (nombre, apPaterno, apMaterno, telefono, correo, img) VALUES (?,?,?,?,?,?)");
            $sql->bindParam(1, $_POST['nombre']);
            $sql->bindParam(2, $_POST['apellidoP']);
            $sql->bindParam(3, $_POST['apellidoM']);
            $sql->bindParam(4, $_POST['telefono']);
            $sql->bindParam(5, $_POST['correo']);
            $sql->bindParam(6, $nomb_foto);
            
            if($sql->execute()){
                try{
                    //Me permite mover la imagen elegita al destino
                    move_uploaded_file($filetemp, $destino.$nomb_foto);
                }catch(Exception $e){
                    $e->getMessage();
                }
                //Mensaje de éxito
                echo "<script>window.alert('Se agregó exitosamente a ". $_POST['nombre']."')</script>";
                echo "<script>window.location='lista_contacto.php'</script>";
            }else{
                //Mensaje de error
                echo "<script>window.alert('No pudo ingresar el contacto.')</script>";
            }
            $database->close(); 
        }
    }
    ?>
</body>
</html>
