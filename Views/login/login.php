
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, 
    minumun-scale=1.0">
    <title>Federación <?php echo $data['tag_page']?></title>
    <link rel="stylesheet" href="Librerias/css/estilosLogin/style.css">
    <link rel="icon" type="image/png" href="<?php echo BASE_URL?>Assets/img/icono.png" />

</head>
<body>
    <section id="container">
        <form action="dashboard" method="post">

            <h3>Iniciar Sesión</h3>            
            <img src="<?php echo BASE_URL?>Assets/img/login2.png" alt="Login">
            <input type="text" name="Usuario" placeholder="Usuario">
            <input type="password" name="Clave" placeholder="Contraseña">
            <div class="alert" style="  text-align: center;color: red;"><?php echo (isset($alert)? $alert :'' ) ?> </div>
            <input type="submit" value="INGRESAR">
            
        </form>
    
    </section>

</body>
</html>
