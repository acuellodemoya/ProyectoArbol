		<?php
		include("nodo.php");

		Class Arbol{

			private $raiz;
			private $cantidad =0;
			private $altura = 0;
			private $pares = 0;
			private $mensaje = "";

			function __construct(){
				$this->raiz =null;
			}

			function crearArbol($raiz){
				$this->raiz = $raiz;
				echo "Arbol creado";
			}


			public function getRaiz(){
				return $this->raiz;
			}

			public function buscar($nodo, $valor) {
				if ($nodo == null) {
					return null;
				}
				if ($nodo->getInfo() == $valor) {
					return $nodo;
				} else {
					$izq = $this->buscar($nodo->getIzquierda(), $valor);
					if ($izq != null) {
						return $izq;
					} else {
						$der = $this->buscar($nodo->getDerecha(), $valor);
						return $der;
					}
				}
			}

			public function agregarNodo ($nodoPadre, $ubicacion, $nodoHijo)
			{
				if ($this->raiz != null) {
					$padre = $this->buscar($this->raiz, $nodoPadre);
					$hijo = $this->buscar($this->raiz, $nodoHijo);
					if ($hijo == null) {
						$hijoNuevo = new Nodo($nodoHijo, $padre->getNivel() + 1);
						if ($padre != null) {
							if ($ubicacion == "izquierda") {
								if ($padre->getIzquierda() == null) {
									$padre->setIzquierda($hijoNuevo);
								} else {
									$nuevo = $padre->getIzquierda();
									$padre->setIzquierda($hijoNuevo);
									$hijoNuevo->setIzquierda($nuevo);
								}
							} else {
								if ($padre->getDerecha() == null) {
									$padre->setDerecha($hijoNuevo);
								} else {
									$nuevo = $padre->getDerecha();
									$padre->setDerecha($hijoNuevo);
									$hijoNuevo->setDerecha($nuevo);
								}
							}
							echo " Agregado Exitosamente";
						}else{
							echo "El Nodo no existe";
						}
					}else{
						echo "El Nodo ya existe";
					}
				}
			}


		function eliminarNodo($nodo) {
			$valor = $this->buscar($this->raiz, $nodo);
			if ($valor != null) {
				if ($this->esHoja($valor)) {
					$padre = $this->buscarPadre($this->raiz, $nodo);
					if ($padre->getIzquierda() != null && $padre->getIzquierda()->getInfo() == $nodo) {
						$padre->setIzquierda(null);
					}
					if ($padre->getDerecha() != null && $padre->getDerecha()->getInfo() == $nodo) {
						$padre->setDerecha(null);
					}
					echo "Nodo eliminado exitosamente";
				} else {
					echo "No se puede eliminar este nodo";
				}
			} else {
				echo "El Nodo no existe";
			}
			echo "<script>draw();</script>";
		}

		function esHoja($nodo) {
			if ($nodo->getIzquierda() == null && $nodo->getDerecha() == null) {
				return true;
			} else {
				return false;
			}
		}

		function contarNodos ($nodo){
			if($nodo == null) {
				return 0;
			}else{
				return 1 + $this->contarNodos($nodo->getIzquierda()) + $this->contarNodos($nodo->getDerecha());
			}
		}

		function buscarPadre($nodo, $valor) {
			if ($nodo == null) {
				return null;
			}
			if (($nodo->getDerecha() != null && $nodo->getDerecha()->getInfo() == $valor) || ($nodo->getIzquierda() != null && $nodo->getIzquierda()->getInfo() == $valor)) {
				return $nodo;
			} else {
				$izquierda = $this->buscarPadre($nodo->getIzquierda(), $valor);
				if ($izquierda != null) {
					return $izquierda;
				} else {
					$derecha = $this->buscarPadre($nodo->getDerecha(), $valor);
					return $derecha;
				}
			}
		}

		function buscarNodosHojas($nodo) {
			if ($nodo != null) {
				if ($nodo->getDerecha() == null && $nodo->getIzquierda() == null) {
					echo $nodo->getInfo() . " -> ";
				}
				$this->buscarNodosHojas($nodo->getIzquierda());
				$this->buscarNodosHojas($nodo->getDerecha());
			}else{
				return null;
			}

		}

		function contarNumerosPares($nodo, $valor) {
			if ($valor) {
				$this->pares = 0;
				$valor = FALSE;
			}
			if ($nodo != null) {
				if ($nodo->getInfo() % 2 == 0) {
					$this->pares += 1;
				}
				$this->contarNumerosPares($nodo->getIzquierda(), FALSE);
				$this->contarNumerosPares($nodo->getDerecha(), FALSE);
			}
			$par = $this->pares;
			return $par;
		}

		function recorridoPorNiveles($nodo) {
			if ($nodo != null) {
				$cola = array();
				$colaAux = array();
				array_unshift($cola, $nodo);
				while (count($cola) != 0) {
					$aux = array_pop($cola);
					array_push($colaAux, $aux);
					if ($aux->getIzquierda() != null) {
						array_unshift($cola, $aux->getIzquierda());
					}
					if ($aux->getDerecha() != null) {
						array_unshift($cola, $aux->getDerecha());
					}
				}
				return $colaAux;
			}
		}

		function PreOrden($nodo) {
			if ($nodo != null) {
				echo $nodo->getInfo() . " -> ";
				$this->PreOrden($nodo->getIzquierda());
				$this->PreOrden($nodo->getDerecha());
			}
		}

		function InOrden($nodo) {
			if ($nodo != null) {
				$this->InOrden($nodo->getIzquierda());
				echo $nodo->getInfo() . " -> ";
				$this->InOrden($nodo->getDerecha());
			}
		}

		function PosOrden($nodo) {
			if ($nodo != null) {
				$this->PosOrden($nodo->getIzquierda(), false);
				$this->PosOrden($nodo->getDerecha(), false);
				echo $nodo->getInfo() . " -> ";
			}
		}

		function arbolCompleto($nodo){
			$completo = 0;
			if ($nodo != null) {
				$altura = $this->altura($this->raiz, true);
				$completo = (pow(2, $altura)) - 1;
				if ($completo == ($this->contarNodos($this->raiz, true))) {
					return true;
				}else{
					return false;
				}
			}
		}

		function calcularAltura($nodo, $valor){
			if ($nodo != null) {
				if ($valor) {
					$this->altura = $nodo->getNivel() + 1;
					$valor = false;
				}
				if ($nodo->getNivel() + 1 > $this->altura) {
					$this->altura = $nodo->getNivel() + 1;
				}
				$this->calcularAltura($nodo->getIzquierda(), false);
				$this->calcularAltura($nodo->getDerecha(), false);
				$altura = $this->altura;
				return $altura;
			}
		}	

		function altura($nodo,$nivel){
			if($nodo==$this->raiz){
				$this->altura=1;
			}
			if($nodo!=null){
				$this->altura($nodo->getIzquierda(),$nivel+1);
				if($nivel>$this->altura){
					$this->altura=$nivel;
				}
				$this->altura($nodo->getDerecha(),$nivel+1);
			}
			return $this->altura;

		}
		function sumaNodos($nodo){
			$suma = 0;
			if ($nodo != null) {
				$suma += $nodo->getInfo();
				$this->sumaNodos($nodo->getIzquierda()) + $this->sumaNodos($nodo->getDerecha());
				return $suma;
			}
		}

		function mostrarNodos($nodo){
			if ($nodo != null) {
				$i=$nodo->getInfo();
				echo "{id: '$i', label: '$i'},";
				$this->mostrarNodos($nodo->getIzquierda());
				$this->mostrarNodos($nodo->getDerecha());
			}
		}

		function mostrarAristas($nodo){
			if ($nodo != null) {
				$h=$nodo->getInfo();
				if ($nodo!=$this->raiz) { 
					$padre = $this->buscarPadre($this->raiz,$h);
					$p=$padre->getInfo();
					echo "{from: $p, to: $h},";
				}
				$this->mostrarAristas($nodo->getIzquierda());
				$this->mostrarAristas($nodo->getDerecha()); 
			}

		}


		}

		?>