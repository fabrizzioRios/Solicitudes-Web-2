
<?php

    if (isset($_POST["idatiende"])) {
        $u = $_POST["u"];
        $id = $_POST["idatiende"];
        alter_data($u, $id);
    }


    function detalleSolicitud ($u) {
        $str = "";
        $connection = connection(); 
        if ($connection) {
            $q = "SELECT * FROM solicitud where Id=".$u."";
            $r = mysqli_query($connection, $q);
            while ($f = mysqli_fetch_assoc($r)) {
                $str .= "<input type='hidden' name='u' value = '".$f["Id"]."'>";
                $str .= "</br>Id: ".$f["Id"];
                $str .= "</br>Descripcion de la solicitud: ".$f["Descripcion"];
                $str .= "</br>Id de la categoria: ".$f["IdCategoria"];
                $str .= "</br>Id del usuario que solicita: ".$f["IdUsuarioSolicita"];
                $str .= "</br>Id del usuario que Atiende: ".$f["IdUsuarioAtiende"];
                $str .= "</br>Id estatus: ".$f["IdEstatus"];
                $str .= "</br>Fecha creacion: ".$f["FechaCreacion"];
                $str .= "</br><button>Asignar</button>";
                $str .= "<a href='solicitudes.php?u=admin'><button type='button'>Regresar</button></a>";
                $str .= "<input type='number' name='idatiende'></br>";
            }
            return $str;

        }   
    }

    function connection () {
        return mysqli_connect("localhost","root","","app02");
    }

    function alter_data ($u, $id) {
        $connection = connection();
        if ($connection) {
            $q = "UPDATE solicitud set IdUsuarioAtiende = ".$id." WHERE Id = ".$u.";";
            mysqli_query($connection, $q);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <?php
            echo detalleSolicitud($_GET["u"]);
        ?>
    </form>
</body>
</html>