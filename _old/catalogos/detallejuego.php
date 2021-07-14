<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/db/detallejuego.php";

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
            <h2>DETALLES DEL JUEGO</h2>
            <p>creado por Carlos Reyes Llamas</p>
            <a href="/index.php" class="w3-button w3-gray">VOLVER A INICIO</a>
        </div>

        <br>

        <div class="w3-container w3-border">
            
            <header class="w3-center">
                <h3>DATOS PRINCIPALES</h3>
            </header>

            <table class="w3-table w3-striped">
                <tr class="w3-border">
                    <th>NOMBRE</th>
                    <th>FECHA DE LANZAMIENTO</th>
                    <th>TIPO DE PRODUCCION</th>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $datos[1]; ?>
                    </td>
                    <td>
                        <?php echo $datos[2]; ?>
                    </td>
                    <td>
                        <?php echo $datos[3]; ?>
                    </td>
                </tr>
                
            </table>
            
            <br>

        </div>

        <br>

        <div class="w3-container w3-border">
            
            <header class="w3-center">
                <h3>DATOS GENERALES</h3>
            </header>

            <div class="w3-container w3-padding">
                
                <header class="w3-center">
                    <h4>PLATAFORMAS</h4>
                </header>

                <table class="w3-table w3-striped w3-small">
                    <tr class="w3-border">
                        <th>NOMBRE</th>
                        <th>MAX JUGADORES</th>
                        <th>COSTO</th>
                        <th>MODS DISPONIBLES</th>
                        <th>VER JUEGOS</th>
                    </tr>
                    
                    <?php for($rows = 0; $rows < count($plataformas); $rows++){; ?>
                    
                    <tr>
                        
                        <td>
                            <?php echo $plataformas[$rows][1]; ?>
                        </td>
                        
                        <td>
                            <?php echo $plataformas[$rows][2]; ?>
                        </td>

                        <td>
                            <?php echo $plataformas[$rows][3]; ?>
                        </td>

                        <td>
                            <?php echo $plataformas[$rows][4] == 0 ? "NO" : "SI"; ?>
                        </td>

                        <td>
                            <a href="/catalogos/juegosplataforma.php?id=<?php echo $plataformas[$rows][0]; ?>">Ver</a>
                        </td>

                    </tr>

                    <?php }; ?>
                    
                </table>
            </div>

            <div class="w3-container w3-third w3-padding">
                
                <header class="w3-center">
                    <h4>GENEROS</h4>
                </header>

                <table class="w3-table w3-striped w3-small">
                    <tr class="w3-border">
                        <th>NOMBRE</th>
                        <th>VER JUEGOS</th>
                    </tr>
                    
                    <?php for($rows = 0; $rows < count($generos); $rows++){; ?>
                    
                    <tr>
                        
                        <td>
                            <?php echo $generos[$rows][1]; ?>
                        </td>
                        
                        <td>
                            <a href="/catalogos/juegosgenero.php?id=<?php echo $generos[$rows][0]; ?>">Ver</a>
                        </td>

                    </tr>

                    <?php }; ?>
                    
                </table>
            </div>
            
            <div class="w3-container w3-third w3-padding">
                
                <header class="w3-center">
                    <h4>PRODUCTORAS</h4>
                </header>

                <table class="w3-table w3-striped w3-small">
                    <tr class="w3-border">
                        <th>NOMBRE</th>
                        <th>VER JUEGOS</th>
                    </tr>
                    
                    <?php for($rows = 0; $rows < count($productoras); $rows++){; ?>
                    
                    <tr>
                        
                        <td>
                            <?php echo $productoras[$rows][1]; ?>
                        </td>
                        
                        <td>
                            <a href="/catalogos/juegosproductora.php?id=<?php echo $productoras[$rows][0]; ?>">Ver</a>
                        </td>

                    </tr>

                    <?php }; ?>
                    
                </table>
            </div>

            <div class="w3-container w3-third w3-padding">
                
                <header class="w3-center">
                    <h4>MUSICOS</h4>
                </header>

                <table class="w3-table w3-striped w3-small">
                    <tr class="w3-border">
                        <th>NOMBRE</th>
                        <th>VER JUEGOS</th>
                    </tr>
                    
                    <?php for($rows = 0; $rows < count($musicos); $rows++){; ?>
                    
                    <tr>
                        
                        <td>
                            <?php echo $musicos[$rows][1]; ?>
                        </td>
                        
                        <td>
                            <a href="/catalogos/juegosmusico.php?id=<?php echo $musicos[$rows][0]; ?>">Ver</a>
                        </td>

                    </tr>

                    <?php }; ?>
                    
                </table>
            </div>

            

            <br>
            <br>
            <br>
            <br>
            <br>

        </div>

	</body>
	
</html>