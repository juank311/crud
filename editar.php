<?php require 'conexion.php'?>

<?php

//Obtener id enviado desde email por metodo GET
$id_user = $_GET['id'];
$name_user = '';
$last_name_user = '';
$phone_user = '';
$email_user = '';

$query = "SELECT * FROM usuarios where id='$id_user' ";
$user = mysqli_query($con, $query) or die (mysqli_error());

//volcar los datos  a una fila en forma de array asociativa 

$row_edit = mysqli_fetch_assoc($user);


if (isset($_POST['editar_registro'])) {
    $name_user = mysqli_real_escape_string ($con, $_POST['name_user']);
    $last_name_user = mysqli_real_escape_string ($con, $_POST['last_name_user']);
    $phone_user = mysqli_real_escape_string ($con, $_POST['phone_user']);
    $email_user = mysqli_real_escape_string ($con, $_POST['email_user']);

    date_default_timezone_set('America/Bogota');
    $time = date('h:i:s  a', time());

    if (!isset($name_user) || trim($name_user) == '' ||
        !isset($last_name_user) || trim($last_name_user) == '' ||
        !isset($phone_user) || $phone_user == '' ||
        !isset($email_user) || trim($email_user) == '') {
            $error =  "ERROR, existen campos vacios";
    }else{
            $query = "UPDATE usuarios SET name_user='$name_user', last_name_user='$last_name_user', phone_user='$phone_user', email_user='$email_user' WHERE id='$id_user' ";
        
        if (!mysqli_query($con, $query)) {
            die('Error: ' . mysqli_error($con));
            $error =  "fallo la actualizacion";
        }else{
            $mensaje = "Se ha actualizado correctamente el usuario";
            header('Location: index.php');
            exit();
            }

    }
        
}


?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>
    <h1 class="text-center">CRUD PHP Y MYSQL</h1>
    <p class="text-center">Aprende a realizar las 4 operaciones básicas entre PHP y una base de datos, en este caso MYSQL: CRUD(Create, Read, Update, Delete)</p>

   
    <div class="container">

    <div class="row">
        <h4 class="text-center">Editar un Registro</h4>
    </div>
        <div class="row">
            <div class="col-sm-4 offset-0">
                <a href="index.php" class="btn btn-success w-20"> USUARIOS</a>
            </div>            
        </div>   

        <div class="row caja" >

        <!-- mensajes de error --> 
        <?php if (isset($error)) : ?>
            <h6 class="bg-danger text-white"><?php echo $error; ?></h6>
        <?php endif ?>
        <!--  -->
        
            <div class="col-sm-6 offset-3">
            <form method="POST" action = "<?php $_SERVER['PHP_SELF']?>">
                <div class="mb-3">
                    <label for="name_user" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="name_user" placeholder="Ingresa el nombre" value="<?php echo $row_edit['name_user'];?>">                    
                </div>
                
                <div class="mb-3">
                    <label for="last_name_user" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="last_name_user" placeholder="Ingresa los apellidos" value="<?php echo $row_edit['last_name_user'];?>">                    
                </div>

                <div class="mb-3">
                    <label for="phone_user" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="phone_user" placeholder="Ingresa el teléfono" value="<?php echo $row_edit['phone_user'];?>">                    
                </div>

                <div class="mb-3">
                    <label for="email_user" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email_user" placeholder="Ingresa el email" value="<?php echo $row_edit['email_user'];?>">                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="editar_registro">Actualizar</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>