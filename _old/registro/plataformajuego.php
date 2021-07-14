<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/db/catalogoplataformas.php";

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
                <h3>Paso 5/5</h3>
            </header>

            <form action="/db/plataformajuego.php" method="post">

                <header class="w3-center">
                    <h4>Selecciona las plataformas que apliquen</h4>
                </header>

                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

                <table class="w3-table w3-striped">
					<tr class="w3-border">
						<th>NOMBRE</th>
						<th>MAX JUGADORES</th>
						<th>COSTO</th>
						<th>MODS DISPONIBLES</th>
						<th>AGREGAR</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($catalogo); $rows++){; ?>
					
					<input type="hidden" name="datos[]" value="<?php echo $catalogo[$rows][0]; ?>">

                    <tr>
						
						<td>
							<?php echo $catalogo[$rows][1]; ?>
						</td>
						
						<td>
							<input type="number" name="max[]" value="0" class="w3-input">
						</td>
						
						<td>
							<input type="number" name="costo[]" value="0" class="w3-input">
						</td>
						
						<td>
							<select name="mods[]" class="w3-select">
								<option value="0" selected>No</option>
								<option value="1">Si</option>
							</select>
						</td>

						<td>
							<input type="checkbox" name="agregar[]" value="<?php echo $rows; ?>" class="w3-check">
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