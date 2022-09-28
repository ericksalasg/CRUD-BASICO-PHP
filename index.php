<?php
    require 'config/database.php';

    $db     = new Database();
    $con    = $db->conectar();

    $activo = 1;

    //CONSULTAS PREPARADAS
    // NORMAL ES - query

    $comando = $con->prepare("SELECT id, codigo, descripcion, stock FROM productos WHERE activo=:mi_activo ORDER BY codigo ASC");

    $comando->execute(['mi_activo'=> $activo]);
    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen</title>

    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="./public/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-4">

    <main class="container">
        <div class="row">
            <div class="col d-flex gap-3">
                <h4>Productos</h4>
                <a href="nuevo.php" class="btn btn-primary floar-right">Nuevo</a>
            </div>
        </div>

        <div class="row py-3">
            <div class="col">
                <table class="table table-border">
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                    <tbody>
                        <?php
                        foreach ($resultado as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['codigo'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['stock'] ?></td>
                            <td><a href="editar.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">Editar</a></td>
                            <td><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</a></td>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL DELETE -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro de eliminar registro seleccionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="eliminar.php?id=<?php echo $row['id'] ?>">Si, Eliminar</a>
                </div>
                </div>
            </div>
            </div>
       
    </main>	

</body>
</html>