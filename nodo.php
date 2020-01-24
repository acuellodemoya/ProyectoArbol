<?php

	Class nodo{

		private $info;
		private $izquierda;
		private $derecha;
		private $nivel;

		function __construct($info, $nivel){
			$this->info = $info;
			$this->nivel = $nivel;
        $this->derecha = null;
        $this->izquierda = null;
    }

		//Getters
		function getInfo(){
			return $this->info;
		}

		function getIzquierda(){
			return $this->izquierda;
		}

		function getDerecha(){
			return $this->derecha;
		}
		 function getNivel(){
		 	return $this->nivel;
		 }

		//Setters
		function setInfo($info){
			$this->info = $info;
		}

		function setIzquierda($izquierda){
			$this->izquierda = $izquierda;
		}

		function setDerecha($derecha){
			$this->derecha = $derecha;
		}

		function setNivel($nivel){
			$this->nivel = $nivel;
		}
	}


?>