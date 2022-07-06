
<?php

    if (isset($_GET["u"])) {
        $u = $_GET["u"];
        if ($u == "admin") {
            solicitudes ();
        }
        else if ($u != "admin") {
            solicitudes_user($u);
        }
    } 
    if (isset($_POST["action"])) {
        $u = $_POST["u"];
        echo $u;
        $estatus = $_POST["action"];
        echo $estatus;

        alter_estatus($u, $estatus);
    }

    function alter_estatus ($u, $e) {
        $connection = connection();
        if ($connection) {
            $q = "UPDATE solicitud set IdEstatus = ".$e." WHERE Id = ".$u.";";
            mysqli_query($connection, $q);
        }
      
    }

    function solicitudes () {
        $connection =connection();
        if ($connection) {
            $q = "SELECT * FROM solicitud";
            $r = mysqli_query($connection, $q);
            $str = "<h1>Lista de solicitudes</h1></br>";
            while ($f = mysqli_fetch_assoc($r)) {
                $str .= "<a href='detalleSolicitud.php?u=".$f["Id"]."'><button type='button'>Editar detalle de la solicitud</button></a>";
                $str .= " " . $f["Id"];
                $str .= " " . $f["Descripcion"]."</br>";
            }
            $str .= "<a href='principal.php?u=admin'><button type='button'>Regresar</button></a>";
            echo $str;
        }
    }

    function solicitudes_user($u) {
        $connection = connection();
        if ($connection) {
            $q = "SELECT * FROM usuarios Where usuario='".$u."'";
            $r = mysqli_query($connection, $q);
            $f = mysqli_fetch_assoc($r);
            $q2 = "SELECT * FROM solicitud where IdUsuarioAtiende='".$f['Id']."' OR IdUsuarioSolicita='".$f['Id']."'";
            $r2 = mysqli_query($connection, $q2);
            $str = "";
            $num = 1;
            while ($f2=mysqli_fetch_assoc($r2) ) {
                $str .= "<form action='' method='POST' name='status".$f2["Id"]."'>";
                $str .= "<input type='hidden' name='u' value = '".$f2["Id"]."'>";
                $str .= "<h2>Solicitud ". $num."</h2>";
                $str .= "</br>Id: ".$f2["Id"];
                $str .= "</br>Descripcion de la solicitud: ".$f2["Descripcion"];
                $str .= "</br>Id de la categoria: ".$f2["IdCategoria"];
                $str .= "</br>Id del usuario que solicita: ".$f2["IdUsuarioSolicita"];
                $str .= "</br>Id del usuario que Atiende: ".$f2["IdUsuarioAtiende"];
                $str .= "</br>Id estatus: ".$f2["IdEstatus"];
                $str .= "</br>Fecha creacion: ".$f2["FechaCreacion"]."</br>";
                $num ++;
                if ($f2["IdUsuarioAtiende"] == $f["Id"]) {
                    if ($f2["IdEstatus"] == 1) {
                        $str .= "<button name='action' value='2'>Iniciar</button>";
                        $str .= "<button name='action' value='3'>Cancelar</button>";
                    }
                    if ($f2["IdEstatus"] == 2) {
                        $str .= "<button name='action' value='3'>Cancelar</button>";
                        $str .= "<button name='action' value='4'>Terminar</button>";
                    }
                }
                $str .= "</form>";

            }
            $str .= "</br><a href='principal.php?u=".$u."'><button type='button'>Regresar</button></a>";
            echo $str;
        }
    }


    function connection () {
        return mysqli_connect("localhost","root","","app02");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
</head>
<body>
    
</body>
</html>