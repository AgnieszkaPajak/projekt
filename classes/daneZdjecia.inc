<?php
	class DaneZdjecia{
		private $id;
		private $nazwa;
		private $galeria;
		private $autor;
		private $lokalizacja;
		
		function __construct() {
		
		}
		
		function setNazwa($zmienna){
			$this->nazwa = $zmienna;
		}
		
		function setGaleria($zmienna){
			$this->galeria = $zmienna;
		}
		
		function setAutor($zmienna){
			$this->autor = $zmienna;
		}
		
		function setLokalizacja($zmienna){
			$this->lokalizacja = $zmienna;
		}
		
		function getNazwa(){
			return $this->nazwa;
		}
		
		function getGaleria(){
			return $this->galeria;
		}
		
		function getAutor(){
			return $this->autor;
		}
		
		function getLokalizacja(){
			return $this->lokalizacja;
		}
		
		
		
		
	}
?>