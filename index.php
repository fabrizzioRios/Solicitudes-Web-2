
<?php
    function validarUsuario ($u, $p) {
        $conn = connection();
        if ($conn) {
            $q = "SELECT count(*) as existe from usuarios WHERE usuario='".$u."' AND password ='".$p."' AND IdEstatus > 1 ";
            $r = mysqli_query($conn,$q);
            while ($f = mysqli_fetch_assoc($r)) {
                $existe = $f["existe"];
            }
        }
        mysqli_close($conn);
        return $existe;
    }

    function connection () {
        return mysqli_connect("localhost","root","","app02");
    }

    
    if(isset($_POST["txtUsr"])) {
        if (validarUsuario($_POST["txtUsr"], $_POST["txtPwd"]) == 1) 
            header("location: principal.php?u=".$_POST["txtUsr"]."");
        else{
            echo "<script> alert('Datos de acceso incorrecto'); </script>";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>
    <section>
        <fieldset>
            <legend>Iniciar Sesion</legend>
            <form method="POST" name="fLogin" action="">
                <p>
                    <input type="text" name="txtUsr" value="" placeholder="Usuario">
                </p>
                <p>
                    <input type="password" name="txtPwd" id="" placeholder="Contraseña">
                </p>
                <button>Iniciar</button>
                <a href="registro.php"><button type="button">Solicitar registro</button></a>
            </form>
        </fieldset>
    </section>
    <footer></footer>
</body>
</html>