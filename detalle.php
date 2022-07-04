
<?php

    function detalle ($u) {
        $str = "";
        $connection = connection(); 
        if ($connection) {
            $q = "SELECT * FROM usuarios where Id=".$u."";
            $r = mysqli_query($connection, $q);
            while ($f = mysqli_fetch_assoc($r)) {
                $str .= "<input type='hidden' name='u' value = '".$f["Id"]."'>";
                $str .= "<input type='hidden' name='admitir' value'1'/>";
                $str .= "</br><p>Nombre: ".$f["Nombre"];
                $str .= "</br>Apellidos: ".$f["Apellidos"];
                $str .= "</br>Sexo: ".$f["Sexo"];
                $str .= "</br>Correo: ".$f["Correo"];
                $str .= "</br>Telefono: ".$f["Telefono"]."<p>";
                if ($f["IdEstatus"] == 1)
                    $str .= "</br><button>Admitir</button>";
            }
        }   
        return $str;
    }

    function admitir ($u) {
        $connection = connection();
        if ($connection) {
            $q = "UPDATE usuarios set IdEstatus = 2 WHERE Id = ".$u.";";
            mysqli_query($connection, $q);
        }

    }

    function connection () {
        return mysqli_connect("localhost","root","","app02");
    }

    if (isset($_GET["u"]) && isset($_GET["admitir"])) {
        admitir($_GET["u"]);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de usuario</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
    <section>
        <form action="">
            <?php
                echo detalle($_GET["u"]);
            ?>
        </form>
    </section>
</body>
</html>