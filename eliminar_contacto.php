<?php
    //Se crea la conexión para la eliminación mediante la instrucción
    include_once("conexion.php");
    if(isset($_GET['idContacto'])){
        $database = new Conecta();
        $db = $database->open();
        $del = $db->prepare("DELETE FROM contactos WHERE idContacto=?");
        $del->bindParam(1, $_GET['idContacto']);
        
        if($del->execute()){
            //Mensaje de Exito
            echo "<script>alert('Se eliminó correctamente')</script>";

        }else{
            //Mensaje de error
            echo "<script>alert('Problema al eliminar";
        }
        $database->close();
    }
    //Redireccion a la lista de contactos
    echo "<script>window.location='lista_contacto.php'</script>";
?>