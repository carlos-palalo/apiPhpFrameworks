<?php


class Framework{
		private $id;
		private $nombre;
		private $lanzamiento;
		private $desarrollador;

		function __construct(){}

		public function getNombre(){
		return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getLanzamiento(){
			return $this->lanzamiento;
		}

		public function setLanzamiento($lanzamiento){
			$this->lanzamiento = $lanzamiento;
		}

		public function getDesarrollador(){
		return $this->desarrollador;
		}

		public function setDesarrollador($desarrollador){
			$this->desarrollador = $desarrollador;
		}
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}
	}

