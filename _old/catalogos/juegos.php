<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/db/catalogojuegos.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Proyecto Integrador</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
	</head>
	
	<body>

		<div class="w3-container w3-center">
            <h1>PROYECTO INTEGRADOR</h1>
            <p>creado por Carlos Reyes Llamas</p>
            <a href="/index.php" class="w3-button w3-gray">VOLVER A INICIO</a>
        </div>

        <br>

        <div class="w3-container w3-border">
            
            <header class="w3-center">
                <h2>CATALOGO DE JUEGOS</h2>
            </header>

            <table class="w3-table w3-striped">
                <tr class="w3-border">
                    <th>NOMBRE</th>
                    <th>VER DETALLE</th>
                </tr>
                
                <?php for($rows = 0; $rows < count($catalogo); $rows++){; ?>
                
                <tr>
                    
                    <td>
                        <?php echo $catalogo[$rows][1]; ?>
                    </td>
                    
                    <td>
                        <a href="/catalogos/detallejuego.php?id=<?php echo $catalogo[$rows][0]; ?>">Ir a detalle</a>
                    </td>

                </tr>

                <?php }; ?>
                
            </table>
            
            <br>
            <br>

        </div>

	</body>
	
</html>