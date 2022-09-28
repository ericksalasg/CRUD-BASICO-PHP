<?php
    require 'config/database.php';

    $db     = new Database();
    $con    = $db->conectar();

    $id = $_GET['id'];

    $query = $con->prepare("SELECT codigo, descripcion,inventariable, stock  FROM productos WHERE id = :id");
    $query->execute(['id' => $id]);
    $row = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="./public/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Editar registro</h3>
            </div>
        </div>

        <div class="row">
            <form class="row g-3" method="POST" action="guarda.php" autocomplete="off">

            <input type="hidden" id="id" name="id" value="<?php echo $id;?>">

                <div class="col-md-4 d-flex align-items-center gap-4">
                    <label for="codigo" class="form-label">Codigo</label>

                    <input class="form-control" type="text" id="codigo" name="codigo" required value="<?php echo $row['codigo'] ?>" autofocus>
                </div>

                <div class="col-md-8 d-flex align-items-center gap-4">
                    <label for="descripcion" class="form-label">Descripción</label>

                    <input class="form-control" type="text" id="descripcion" name="descripcion" required value="<?php echo $row['descripcion'] ?>">
                </div>

                <h5>Inventario</h5>

                <div class="col-md-12">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"
                        name="inventariable" 
                        id="inventariable"
                        value="1"
                        <?php
                        if($row['inventariable']){ echo 'checked';}
                        ?>
                        >
                        <label for="inventariables" class="form-check-label">
                        Usa inventario</label>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-center gap-4">
                    <label for="stock" class="form-label">Existencias</label>

                    <input class="form-control" type="text" id="stock" name="stock" value="<?php echo $row['stock'] ?>">
                </div>

                <div class="col-md-12 mt-5">
                    <a href="/CRUD-PDO/" class="btn btn-secondary">Regresar</a>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
       
    </div>	

</body>
</html>