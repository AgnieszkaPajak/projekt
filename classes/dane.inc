<?php

class Dane {

    private $id;
    private $login;
    private $haslo;
    private $dataUrodzenia;
    private $noGaleries;
    private $mail;

    function __construct($login, $haslo) {
        $this->login = $login;
        $this->haslo = $haslo;
    }

    
       
    public function zwrocLogin() {
        return $this->login;
    }

    public function ustawLogin($login) {
        $this->login = $login;
    }
	

    
    public function zwrocMail() {
        return $this->mail;
    }

    public function ustawMail($mail) {
        $this->mail = $mail;
    }
       

    public function zwrocDate() {
        return $this->dataUrodzenia;
    }
    
    public function zwrocNoGaleries() {
        return $this->noGaleries;
    }

    public function ustawNoGaleries($ile){
        $this->noGaleries = $ile;
    }

    public function dodajGalerie() {
        $this->noGaleries = noGaleries + 1;
    }


    public function ustawDate($dataUrodzenia) {
        $this->dataUrodzenia = $dataUrodzenia;
    }

    

    public function zwrocHaslo() {
        return $this->haslo;
    }

    public function ustawHaslo($pas){
        $this->haslo = $pas;
    }

    public function znajdzDane($login, $haslo) {
	require_once('db_connect.inc');
        $query = "SELECT * FROM Users WHERE Login='$login' AND Password='$haslo';";
        $result = @mysql_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        if($result === FALSE) {
				return "bla";
		}
		$tmp='ble';
		while($row = mysql_fetch_array($result))
		{
				$tmp = $row[2];
		}
		return $tmp;
    }

    public function zmienDane($login, $haslo) {
        require_once('db_connect.inc');
        $du = $_POST['data_urodzenia'];        
        $email = $_POST['mail'];
        $loginNew = $_POST['log'];
        $query = "UPDATE Users SET Birthday='$du', Mail='$email', Login = '$loginNew' WHERE Login = '$login' AND Password = '$haslo';";
        $result = @mysql_query($query);
        if ($result) {
			$this->login = $loginNew;
			$this->dataUrodzenia=$du;
			$this->mail=$email;
			$dane = new Dane($this->login,$haslo);
			$dane->ustawLogin($this->login);
			$dane->ustawMail($this->mail);
			$dane->ustawDate($this->dataUrodzenia);
			$_SESSION['dane']=$dane;
			  $_SESSION['data']=serialize($_SESSION['dane']);
            echo 'Dane zmieniono.';
        } else {
            echo 'Wystąpił błąd.';
        }
    }

    

    public function zmienHaslo($slog, $shas) {
	require_once('db_connect.inc');
        $has = $_POST['new'];
		$shas = SHA1($shas);
		$has = SHA1($has);
        $query = "UPDATE Users SET Password = '$has' WHERE Login = '$slog' AND Password = '$shas';";
        $result = @mysql_query($query);
        if ($result) {
            echo 'Dane zmieniono. Zaloguj się ponownie.';
        } else {
            echo 'Wystąpił błąd.';
        }
    }

    public function ustawId($id) {
        $this->id = $id;
    }

    public function zwrocId() {
        return $this->id;
    }

}

?>