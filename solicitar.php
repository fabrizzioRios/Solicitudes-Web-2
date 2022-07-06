
<?php

    function agregaSolicitud () {
        $connection = connection();
        if ($connection) {
            $q = " call agregaSolicitud('".$_POST["u"]."',".$_POST["listaCategorias"].",'".$_POST["txtDescripcion"]."');";
            mysqli_query($connection, $q);
        }

    }

    function connection () {
        return mysqli_connect("localhost","root","","app02");
    }

    if (isset($_POST["u"])) {
        agregaSolicitud();
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
        function validarAgregar(){
           
            f = document.getElementById("fSolicitar");

            if(f.listaCategorias.value == "" || f.txtDescripcion.value == "" )
                alert("Todos los campos deben ser llenados");
            else
                f.submit();
        }
    </script>
</head>
<body>
    <h1>Nueva Solicitud</h1>
    <form action="" method="POST" name="fSolicitar" id="fSolicitar">
        <input type="hidden" name="u" value="<?php echo $_GET['u']; ?>">
        <p>
            <label for="">Categoría</label>
            <select name="listaCategorias" id="listaCategorias">
                <option value="">Seleccione</option>
                <option value="1">Cat 1</option>
                <option value="2">Cat 2</option>
                <option value="3">Cat 3</option>
            </select>
        </p>
        <p>
            <label for="txtDescripcion">Descripción:</label>
            <textarea name="txtDescripcion" id="txtDescripcion"></textarea>
        </p>
        <?php
        $str = "";
        
        $str .= "<button type='button' onclick='validarAgregar();'>Solicitar</button>";
        $str .= "<button type='button' ><a href='principal.php?u=".$_GET["u"]."'>Regresar</a></button>";
        echo $str;
        ?>

    </form>
</body>
</html>