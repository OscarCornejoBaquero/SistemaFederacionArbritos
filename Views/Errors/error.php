<!DOCTYPE html>
<html lang="es">
<head>
    <!--LLamado al Archivo head.php que contiene todos los atributos de la página-->
    <?php require_once "includes/head.php";?>
    <!--Llamado al archivo ViewsError que se usa para el contendio de la página de inicio-->
    <link rel="stylesheet" href="Librerias/css/estilosVistas/ViewsError.css">
</head>

<body>
    <div class="contenedor_body">
    <!--Llamado al archivo header que contiene la cabecera del Sistema,
    junto con el Nav para todas las páginas-->
    <div>
        <!--Div para separar el Header y Nav-->
    <?php require_once "includes/header.php"?>
    </div>
    
    <div class="contenido_Error">
        <!--Div para separar el Main y Contenido de la página-->
        <img src="./Assets/img/error-404-not-found.png" alt="Error"> 
        <div>
        <h1>No se puede encontrar la Página Solicitada</h1>
        <br>
        <h2>Por favor verifique el nombre y vuelva a intentarlo.</h2>
        </div>
    </div>
    




    


    </div>
    <!--LLamado del Footer de la Pagina Web-->
    <?php require_once "includes/footer.php"?>
    <!--Llamado al archivo de Scripts e incorporarlo en las páginas-->
    <?php require_once "includes/scripts.php"?>
</body>

</html>
