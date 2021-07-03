<!DOCTYPE html>
<html lang="es">
<head>
    <!--LLamado al Archivo head.php que contiene todos los atributos de la página-->
    <?php require_once "includes/head.php";?>
</head>

<body>
    <div class="contenedor_header">
    <!--Llamado al archivo header que contiene la cabecera del Sistema,
    junto con el Nav para todas las páginas-->
    <?php require_once "includes/header.php"?>

    <h1><?php echo $data['page_title']; ?></h1>

    </div>
    <!--LLamado del Footer de la Pagina Web-->
    <?php require_once "includes/footer.php"?>
    <!--Llamado al archivo de Scripts e incorporarlo en las páginas-->
    <?php require_once "includes/scripts.php"?>
</body>

</html>
