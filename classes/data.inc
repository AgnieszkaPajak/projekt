<?php
class Data{
	private $id;
	private $login;
	private $mail;
	private $icon;
	private $noGaleries;
	private $birthday;
	
	public function __construct() {
        
    }
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setMail($mail){
		$this->mail=$mail;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function setIcon($icon){
		$this->icon = $icon;
	}
	
	public function setNoGaleries($no){
		$this->noGaleries = $no;
	}
	
	public function setBirthday($day){
		$this->birthday = $day;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getMail(){
		return $this->mail;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getIcon(){
		return $this->icon;
	}
	
	public function getNoGaleries(){
		return $this->noGaleries;
	}
	
	public function getBirthday(){
		return $this->birthday;
	}
}
?>