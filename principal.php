
<?php

    function verUsuariosRegistrados () {
        $conn = connection();
        $str = "";
        if ($conn) {
            $q = "SELECT * FROM usuarios";
            $r = mysqli_query($conn, $q);
            while ($f = mysqli_fetch_assoc($r)) {
                $str .= "<a href='detalle.php?u=".$f["Id"]."'><button type='button'>Ver detalle</button></a>";
                $str .= " " . $f["Nombre"];
                $str .= " " . $f["Apellidos"]."</br>";
            }
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
    <title>Lista de usuarios</title>
</head>
<body>
    <h1>   
        Hola
    </h1>     

    <section>
        <?php

            if(isset($_GET["u"])){
                $u = $_GET["u"];
        echo "<h1>Lista de usuarios</h1></br>";
                if ($u == "admin") {
                    verUsuariosRegistrados();
                }
                else {
                    echo "<button><a>Ver mis solicitudes</a></button>";
                    echo "</br><a href='solicitar.php?u=".$_GET["u"]."'>realizar solicitudes</a>";                }
            }

        ?>
    </section>
        </br>
    <a href="index.php">
        <button type="button">Regresar</button>
    </a>
</body>
</html>