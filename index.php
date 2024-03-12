<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "ejemplo";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
  die("Error de conexión: " . mysqli_connect_error());
}

$mensaje = "bien";

if (isset($_POST['registro'])) {
  $name = mysqli_real_escape_string($enlace, $_POST['name']);
  $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);

  $insertarDatos = "INSERT INTO clase (name, descripcion) VALUES ('$name', '$descripcion')";
  $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

  if ($ejecutarInsertar) {
    $mensaje = "Datos insertados correctamente.";
  } else {
    $mensaje = "Error al insertar datos: " . mysqli_error($enlace);
  }
}

if (isset($_POST['editar'])) {
  $id = $_POST['id'];
  $name = mysqli_real_escape_string($enlace, $_POST['name']);
  $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);

  $editarDatos = "UPDATE clase SET name='$name', descripcion='$descripcion' WHERE id='$id'";
  $ejecutarEditar = mysqli_query($enlace, $editarDatos);

  if ($ejecutarEditar) {
    $mensaje = "Datos editados correctamente.";
  } else {
    $mensaje = "Error al editar datos: " . mysqli_error($enlace);
  }
}

if (isset($_POST['borrar'])) {
  $id = $_POST['id'];

  $borrarDatos = "DELETE FROM clase WHERE id='$id'";
  $ejecutarBorrar = mysqli_query($enlace, $borrarDatos);

  if ($ejecutarBorrar) {
    $mensaje = "Datos borrados correctamente.";
  } else {
    $mensaje = "Error al borrar datos: " . mysqli_error($enlace);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>crud</title>
</head>
<body>
    <div class="container mt-5">
        <?php
        if (!empty($mensaje)) {
          echo '<div class="alert alert-success" role="alert">' . $mensaje . '</div>';
        }
        ?>
        <form action="#" name="clase" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">ID (Para editar/borrar)</label>
                <input type="text" name="id" class="form-control" id="exampleInputPassword1">
            </div>
            
            <button type="submit" name="registro" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Insertar
            </button>

            <button button type="submit" name="editar" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
            </button>

            <button type="submit" name="borrar" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Borrar
            </button>

      </form>
    </div>
  </body>
</html>
