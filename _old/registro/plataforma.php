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
                <h2>REGISTAR NUEVA PLATAFORMA</h2>
            </header>

            <form action="/db/nuevaplataforma.php" method="post">
                <input type="text" name="plataforma" placeholder="Ingrese nombre de la Plataforma" class="w3-threequarter w3-input w3-border">
                <input type="submit" class="w3-quarter w3-button w3-gray">
            </form>
            
            <br>
            <br>

        </div>

	</body>
	
</html>