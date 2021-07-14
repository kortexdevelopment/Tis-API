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

        <div class="w3-container w3-center w3-green w3-hide <?php echo isset($_GET["registro"]) ? "w3-show" : ""; ?>">
            <h2>REGISTRO REALIZADO CORRECTAMENTE</h2>
        </div>

        <div class="w3-container w3-center w3-red w3-hide <?php echo isset($_GET["error"]) ? "w3-show" : ""; ?>">
            <h2>ERROR DURANTE EL REGISTRO</h2>
        </div>
        
        <br>

        <div class="w3-container w3-border">
            
            <header class="w3-center">
                <h2>REGISTAR NUEVO JUEGO</h2>
                <h3>Paso 1/5</h3>
            </header>

            <form action="/db/nuevojuego.php" method="post">
                <div class="w3-padding">
                    <label for="titulo" class="w3-border-bottom">Titulo</label>
                    <input id="titulo" type="text" name="titulo" placeholder="Ingrese nombre del juego" class="w3-input w3-border" required>

                    <br>

                    <label for="lanza" class="w3-border-bottom">Fecha Lanzamiento</label>
                    <input id="lanza" type="date" name="lanza" class="w3-input w3-border" required>

                    <br>

                    <label for="tipo" class="w3-border-bottom">Tipo de Produccion</label>
                    <select id="tipo" class="w3-select" name="tipo" required>
                        <option value="" disabled selected>Opciones</option>
                        <option value="AAA">AAA</option>
                        <option value="Indi">Independiente</option>
                        <option value="Mix">Mixto</option>
                    </select>

                </div>

                <br>
                <br>

                <input type="submit" class="w3-block w3-button w3-gray">
            </form>
            
            <br>
            <br>

        </div>

	</body>
	
</html>