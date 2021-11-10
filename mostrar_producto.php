<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript">
        setTimeout(function() { window.location.href = "index.html";}, 5000);
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
<body style="background-color:gray;">
  <h1 style='text-align: center'>
    <?php
        include ("./inc/settings.php");
      
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE id=".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
              echo "<img src='img/Cosco2.png' alt='' width='-300dp' height='-300dp'><br>";             
              echo $result["Nombre_del_producto"]."<br>";
              echo "<img src='".$result["Imagen_producto"]."' width='150px' height='150px'><br>"; 
              echo "Cantidad disponible: ".$result["Cantidad_Disponible"]."<br>";
              echo "<p style=color:red>"."$".$result["Precio"]."<br></p>";

            }
            else{
              echo "<img src='img/Cosco2.png' alt='' width='-300dp' height='-300dp'><br>";              
              echo "No se encontro el producto <br>";
              echo "<img src='img/face_dead.png' alt='' width='10%' height='10%'><br>";
              echo "Por favor vuelve intentar o si tiene algun problema consulte con el sopote tecnico para mas información<br>";
            }
            
            
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>