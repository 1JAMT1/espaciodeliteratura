<?php
    require '../../includes/config/database.php';
    $db=conectarDB();
    //var_dump($db);
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
<link rel="stylesheet" href="../../cssa/bootstrap.min.css">
    <main class="contenedor seccion">
        <br>
        <a href="/espaciodeliteratura/admin/pedido/crear.php" class="btn btn-success">Nuevo Pedido</a>
        <br><br>
        <h1> Listado de Pedidos </h1>
        <h3>
        <table class="table table-striped">
            <thead>
                <th> Cantidad </th>
                <th> Fecha de Compra </th>
                <th> Usuario </th>
                <th> Libro </th>
                <th colspan="2"> Acciones </th>
            </thad>
            <tbody>
                <?php
                    $consql=("SELECT p.*,v.* FROM pedido
                    p INNER JOIN usuarios v ON 
                    p.idusuario=v.idusuario ");
                    $resultado=mysqli_query($db,$consql);
                    while($var=mysqli_fetch_array($resultado))
                    {
                ?>
                <tr>

                        <td><?php echo $var['cantidad']; ?> </td>
                        <td><?php echo $var['fechacompra']; ?> </td>
                        <td><?php echo $var['nickname']; ?> </td>
                        <?php
                            $codLibro=$var['idlibro'];
                            $con_sql="SELECT * FROM libros WHERE idlibro='$codLibro'";
                            $pregunta=mysqli_query($db,$con_sql);
                            $libro=mysqli_fetch_array($pregunta);
                        ?>
                        <td><?php echo $libro['titulo']; ?> </td>
                        <td><a href="borrar.php?cod=<?php echo $var['idpedido']; ?>"class="btn btn-danger">Eliminar</a></td>
                        <td><a href="actualizar.php?cod=<?php echo $var['idpedido']; ?>"class="btn btn-info">Actualizar</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        </h3>
        <a href="/espaciodeliteratura/BASEDEDATOS.php" class="btn btn-warning">Volver</a>
        <br><br>
    </main>
    <script src="../../jsa/bootstrap.min.js" ></script>
<?php
    incluirTemplate('footer');
?>