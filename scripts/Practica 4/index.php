<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar" id="">
            <input type="submit" value="Buscar">
            <a href="index.php"></a>
        </form>
    </div>

    <div>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Descripcion</td>
            </tr>
            <?php
            $cnx =  mysqli_connect("localhost", "root", "", "registros_db");
            $sql = "SELECT `id`, `nombre`, `descripcion` FROM registros order by id desc";
            $rta = mysqli_query($cnx, $sql);
            while ($mostrar =  mysqli_fetch_row($rta)) {
            ?>
                <tr>
                    <td><?php echo $mostrar['0'] ?></td>
                    <td><?php echo $mostrar['1'] ?></td>
                    <td><?php echo $mostrar['2'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>