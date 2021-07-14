<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/db/catalogogeneros.php";

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
        </div>

        <br>

        <div class="w3-container w3-border">
            
            <header class="w3-center">
                <h2>REGISTAR NUEVO JUEGO</h2>
                <h3>Paso 2/5</h3>
            </header>

            <form action="/db/generojuego.php" method="post">

                <header class="w3-center">
                    <h4>Selecciona los Generos que apliquen</h4>
                </header>

                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

                <table class="w3-table w3-striped">
					<tr class="w3-border">
						<th>NOMBRE</th>
						<th>AGREGAR</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($catalogo); $rows++){; ?>
					
                    <tr>
						
						<td>
							<?php echo $catalogo[$rows][1]; ?>
						</td>
						
						<td>
							<input type="checkbox" name="datos[]" value="<?php echo $catalogo[$rows][0]; ?>">
						</td>

					</tr>

					<?php }; ?>
					
				</table>
                
				<br>

                <input type="submit" class="w3-block w3-button w3-gray">

            </form>
            
            <br>
            <br>

        </div>

	</body>
	
</html>