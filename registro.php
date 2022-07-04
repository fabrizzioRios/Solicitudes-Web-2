
<?php

    if (isset($_POST["txtUsr"])) {
        $u = $_POST["txtUsr"];
        $p = $_POST["txtPwd1"];
        $n = $_POST["txtNombre"];
        $a = $_POST["txtApellido"];
        $s = $_POST["rdSex"];
        $c = $_POST["txtCorreo"];
        $t = $_POST["txtTelefono"];
        $i = 1;
        registrarUsuario($u, $p, $n, $a, $s, $c, $t, $i);
    }

    function registrarUsuario ($u, $p, $n, $a, $s, $c, $t, $i) {
        $conn = connection();
        if ($conn) {
            $q = "INSERT INTO usuarios(usuario, password, Nombre, Apellidos, Sexo, Correo, Telefono, IdEstatus) VALUES ('".$u."','".$p."','".$n."','".$a."','".$s."','".$c."','".$t."',".$i.")";
            mysqli_query($conn,$q);
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
    <title>Document</title>
    <script>
        function login () {
            validado = true;
            f = document.getElementById("fRegistro");
            if (f.txtPwd1.value != f.txtPwd2.value){
                    alert("Las contraseñas no coinciden");
            }
            if (f.txtNombre.value == "" || f.txtUsr.value == "" || f.txtPwd1.value == "") {
                validado = false;
                f.txtUsr.style.borderColor = "red";
                f.txtNombre.style.borderColor = "red";
                f.txtUsr.style.borderColor = "red";
                f.txtPwd1.style.borderColor = "red";
                f.txtPwd2.style.borderColor = "red";

            }
            if(validado == true) {
                f.submit();
            }
        }
    </script>
</head>
<body>
    <legend> Registrarse </legend>
    <form action="" name="fRegistro" method="POST" id="fRegistro">
        <p>
            <label for="txtUsr">Usuario</label>
            <input type="text" name="txtUsr" value="">
        </p>
        <p>
            <label for="txtPwd1">Contraseña</label>
            <input type="text" name="txtPwd1" value="">
            <label for="txtPwd2">Contraseña</label>
            <input type="text" name="txtPwd2" value="">
        </p>
        <p>
            <label for="txtNombre">Nombre</label>
            <input type="text" name="txtNombre" value="">
        </p>
        <p>
            <label for="txtApellido">Apellidos</label>
            <input type="text" name="txtApellido" value="">
        </p>
        <p>
            <label for="rdSex">Sexo</label>
            <input type="radio" name="rdSex" value="F">Femenino
            <input type="radio" name="rdSex" value="M">Masculino
        </p>
        <p>
            <label for="txtCorreo">Correo</label>
            <input type="email" name="txtCorreo" value="">
        </p>
        <p>
            <label for="txtTelefono">Telefono</label>
            <input type="text" name="txtTelefono" value="">
        </p>
        <button type="button" onclick="login()">Registrarse</button>
        <a href="index.php">
            <button type="button">Cancelar</button>
        </a>
    </form>
</body>
</html>