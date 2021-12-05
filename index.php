<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Consumindo dados webservice</title>
	</head>
	<body>
		<?php
			$url="https://swapi.dev/api/people/";
			//json_decode - Função que analisa a string codificada JSON e converte-a em uma variável do PHP.
			//file_get_contents -  Função que lê todo o conteúdo de um arquivo para uma String
			$resultado = json_decode(file_get_contents($url));
			
			
			//var_dump($resultado);
			
			
			foreach ($resultado->results as $ator){
				echo "Ator: " . $ator->name . "<br>";
				echo "Ator: " . $ator->height . " cm <br>";
				foreach ($ator->films as $filme){
					echo "Filme: " . $filme;
					
				}
				echo "<hr>";
			}
			

		?>
	</body>
</html>
