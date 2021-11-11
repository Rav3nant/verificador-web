<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <title>Producto</title>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "pagina.html";
        }, 5000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
</head>
<body class="bg-warning">
  <h1 style='text-align: center' class="text-dark">
    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE numeroProducto = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
              echo "Producto: ".$result["nombreProducto"]."<br>";
              echo "Precio: ".$result["precioProducto"]."<br>";
              echo "Stock: ".$result["cantidadProducto"]."<br>";
              echo "<img src='".$result["imagenProducto"]."' class='img-thumbnail image'>";
            }
            else{
              echo "No se encuentra el producto <br>";
              echo "<img src='img/error.png' alt='' width='50%' height='50%'>";
            }
            
            
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>