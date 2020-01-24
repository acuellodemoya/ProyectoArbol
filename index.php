<?php
	include ("arbol.php");
	session_start();
	if (!isset($_SESSION['arbol'])) {
		$_SESSION['arbol'] = new Arbol();
	}
	$_SESSION['ubicacion'] = "";
	?>
<!DOCTYPE html>
<html>
<head>
			<title>Arbolbinario</title>
			<link rel="stylesheet" type="text/css" href="style.css">
			

			<div id="contenedorArbol"> </div>
			

			<script type="text/javascript" src="vis/dist/vis.js"></script>
			<link rel="stylesheet" type="text/css" href="vis/dist/vis.css">

		</head>


		<body>
			<h1><center>Proyecto Arbol Binario 	<img src="imagenes/arbol.jpg" style="max-width: 45px; max-height: 45px"></center></h1>

			<p><center>
				Alejandro Cuello<br>
				Maria Maza<br>
				Gabriel Sandoval
			</center>
		</p>
		<hr>
		<div id="cajaMetodos1">
			<center>
				<h3><img src="imagenes/crear.png" style="max-width: 25px; max-height: 25px">Crear Arbol</h3>
				<form action="index.php" method="post">
					Nombre de la raiz: <input type="number" name="nombreRaiz" value="Nombre de la raiz">
					<input type="submit" value="Crear" id="btnCrearArbol" >
				</form> 
				<h3><img src="imagenes/agregar.png" style="max-width: 25px; max-height: 25px">Agregar Nodo</h3>
				<form action="index.php" method="post">
					Nombre del papá: <input type="number" name="nombrePadreCrearNodo"><br>
					<label><input type="radio" name="ubicacion" value="izquierda">Izquierda</label><br>
					<label><input type="radio" name="ubicacion" value="derecha">Derecha</label><br>
					Nombre del hijo: <input type="number" name="nombreHijoCrearNodo"><br>
					<input type="submit" value="Agregar" id="btnAgregarNodo" >
				</form>
				<h3><img src="imagenes/eliminar.png" style="max-width: 25px; max-height: 25px">Eliminar Nodo</h3>
				<form action="index.php" method="post">
					Nombre del Nodo: <input type="number" name="nombreNodoEliminar"> <input type="submit" id="btnEliminarNodo" value="Eliminar" >
				</form> <br><br>
			</center>
		</div>

		<div id= "caja2">
			<div id="cajaMetodos2">
				<center>
					<form action="index.php" method="post"> 
						<input type="text" name="contarNodos" hidden><br>
						<input type="submit" value="Contar nodos" id="btnContarNodos"> <br>
					</form>

					<form action="index.php" method="post"> 
						<input type="text" name="contarPares" hidden><br>
						<input type="submit" value="Contar numeros pares" id="btnContarNumerosPares"><br>
					</form>

					<form action="index.php" method="post"> 
						<input type="text" name="recorridoPreOrden" hidden><br>
						<input type="submit" value="R. Preorden" id="btnRecorridoPreOrden"><br>
					</form>
					
					<form action="index.php" method="post"> 
						<input type="text" name="recorridoInOrden" hidden><br>	
						<input type="submit" value="R. Inorden" id="btnRecorridoInOrden"><br>
					</form>

					<form action="index.php" method="post"> 
						<input type="text" name="recorridoPosOrden" hidden><br>
						<input type="submit" value="R. Posorden" id="btnReorridoPosOrden"><br>
					</form>
					
				</center>												
			</div>

			<div id="cajaMetodos3" >
				<center>
					<form action="index.php" method="post"> 
						<input type="text" name="arbolCompleto" hidden><br>
						<input type="submit" value="¿Es arbol completo?" id="btnArbolCompleto"><br>
					</form>
					

					<form action="index.php" method="post"> 
						<input type="text" name="recorridoPorNiveles" hidden><br>
						<input type="submit" value="Recorrido por niveles" id="btnRecorridoPorNiveles"><br>
					</form>
					
					<form action="index.php" method="post"> 
						<input type="text" name="verNodosHojas" hidden><br>
						<input type="submit" value="Ver nodos hojas" id="btnVerNodosHojas"><br>
					</form>
					
					<form action="index.php" method="post"> 
						<input type="text" name="calcularAltura" hidden><br>
						<input type="submit" value="calcular altura" id="btnCalcularAltura"><br>
					</form>
				</center>
			</div>
		</div>

		<div id="Mensajes">

			<?php
		//Crear nodo padre(Raiz)
			if (isset($_POST['nombreRaiz'])) {
				$nuevo = new Nodo ($_POST['nombreRaiz'],0);	
				$_SESSION['arbol']->crearArbol($nuevo);
			}

		//Crear nodos hijos
				//Crear nodos hijos
	if (isset($_POST['nombrePadreCrearNodo']) && isset($_POST['nombreHijoCrearNodo']) && isset($_POST['ubicacion'])) {
		if($_SESSION['arbol']->buscar($_SESSION['arbol']->getRaiz(), $_POST['nombrePadreCrearNodo'] ) != null){
			$_SESSION['arbol']->agregarNodo($_POST['nombrePadreCrearNodo'], $_POST['ubicacion'], $_POST['nombreHijoCrearNodo']);
		}else{
			echo "El nodo al que desea agregar el hijo no existe...";
		}
	}
		//Eliminar nodos
				//Eliminar nodos
			if (isset($_POST['nombreNodoEliminar'])) {
				$nodo = $_SESSION['arbol']->eliminarNodo($_POST['nombreNodoEliminar']);
			}
		//Contar todos los nodos del arbol
			if (isset($_POST['contarNodos'])) {
				$raiz = $_SESSION['arbol']->getRaiz();
				$nodos = $_SESSION['arbol']->contarNodos($raiz);
				echo "La cantidad de nodos creados es ".$nodos;
			}

				//Contar los numeros pares
			if (isset($_POST['contarPares'])) {
				echo "La cantidad de numeros pares es: ". $_SESSION['arbol']->contarNumerosPares($_SESSION['arbol']->getRaiz(), true);

			}

				//Recorrer el arbol por niveles
			if (isset($_POST['recorridoPorNiveles'])) {
				$resultado = "";
				echo "Recorrido por niveles: ";
				$aux = $_SESSION['arbol']->recorridoPorNiveles($_SESSION['arbol']->getRaiz());
				foreach ($aux as $key => $value) {
					$resultado = $resultado . $value->getInfo() . " -> ";
				}
				echo $resultado;
			}

				//Recorrido Preorden
			if (isset($_POST['recorridoPreOrden'])) {
				echo "Recorrido PreOrden: ";
				echo  $_SESSION['arbol']->PreOrden($_SESSION['arbol']->getRaiz());
			}  

				//Recorrido Inorden
			if (isset($_POST['recorridoInOrden'])) {
				echo "Recorrido InOrden: ";
				echo  $_SESSION['arbol']->InOrden($_SESSION['arbol']->getRaiz());
			} 

				//Recorrido Posorden
			if (isset($_POST['recorridoPosOrden'])) {
				echo "Recorrido PosOrden: ";
				echo  $_SESSION['arbol']->PosOrden($_SESSION['arbol']->getRaiz());
			} 

				//Arbol completo
			if (isset($_POST['arbolCompleto'])) {
				if( $_SESSION['arbol']->arbolCompleto($_SESSION['arbol']->getRaiz())){
					echo "El arbol es completo";
				}else{
					echo "El arbol no es completo";
				}
			} 

				//Mostrar nodos hojas
			if (isset($_POST['verNodosHojas'])) {
				echo "Nodos Hojas: ";
				echo  $_SESSION['arbol']->buscarNodosHojas($_SESSION['arbol']->getRaiz());
			} 

				//Calcular altura del arbol
			if (isset($_POST['calcularAltura'])) {
				$altura =$_SESSION['arbol']->altura($_SESSION['arbol']->getRaiz(),1);
				echo "Altura: ". $altura;
			} 

			?>
		</div>
		<script type="text/javascript">
				//creación de array de nodos
				var nodos = new vis.DataSet([
					<?php
					$raiz = $_SESSION['arbol']->getRaiz();
					$_SESSION['arbol']->mostrarNodos($raiz);
					?> 
					]);
				var aristas = new vis.DataSet([
					<?php
					$raiz = $_SESSION['arbol']->getRaiz();
					$_SESSION['arbol']->mostrarAristas($raiz);
					?> 
					]);
				var contenedor = document.getElementById("contenedorArbol");
				var datos = {
					nodes: nodos,
					edges: aristas	
				};
				var opciones={
					nodes:{
						color: {
							border: '#083A8B' ,
							background: '#83AAEA ',
							highlight: {
								border: '#083A8B',
								background: '#C6EF83 '
							},
							hover: {
								border: '#083A8B',
								background: 'blue'
							}
						}
					},
					layout: {
						hierarchical: {
							direction: "UD",
							sortMethod: "directed"
						}
					},
					edges:{
						arrows:{
							to:{					
							}
						},
						color: {
							color:'black',
							highlight:'black',
							hover: 'black'
						}
					}
				};
				var arbol= new vis.Network(contenedor,datos,opciones);
			</script>

		</body>
		</html>