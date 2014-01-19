<?php
class DaneGalerii{
	private $autor;
	private $nazwa;
	private $ilZdjec;
	private $data;
	private $kategoria;
	function __construct() {
    }
	
	public function setAutor($autor){
		$this->autor = $autor;
	}
	
	public function setNazwa($zmienna){
		$this->nazwa = $zmienna;
	}
	
	public function setilZdjec($zmienna){
		$this->ilZdjec = $zmienna;
	}
	
	public function setData($zmienna){
		$this->data = $zmienna;
	}
	
	public function setKategoria($zmienna){
		$this->kategoria = $zmienna;
	}
	
	public function getAutor(){
		return $this->autor;
	}
	
	public function getNazwa(){
		return $this->nazwa;
	}
	
	public function getilZdjec(){
		return $this->ilZdjec;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function getKategoria(){
		return $this->kategoria;
	}
}
?>