<?php

class User {
	
	public function __construct() {
    }
	private $data;
	
	public function zaloguj($login, $password)
	{
		include_once('loggeduser.inc');
		$message = '';
		$pass = SHA1($password);
		require_once('db_connect.inc');
		$query = "SELECT * FROM Users WHERE Login='$login' AND Password='$pass';";
        if(!$result = mysql_query($query))
		{
			echo '<code>$query</code> &rarr; '.mysql_error().' ('.mysql_errno().')';
			
			
		
		}
		if(mysql_num_rows($result)==0){
			$message='Błędny login lub hasło!';
		}else {
			include_once('dane.inc');
			$this->data = new Dane($login,$pass);
			$message = 'Poprawnie zalogowano';
			$id='';
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$id=$row[0];
                $this->data->ustawId($id);
				$this->data->ustawLogin($row[1]);
				$tmp = $row[3];
				$this->data->ustawMail($tmp);
				$tmp = $row[4];
				$this->data->ustawNoGaleries($tmp);
				$tmp=$row[5];
				$this->data->ustawDate($tmp);				
              }
			  
			  $_SESSION['dane']=$this->data;
			  $_SESSION['data']=serialize($_SESSION['dane']);
			  $_SESSION['logged'] = new LoggedUser($id);
			  $_SESSION['serial'] = serialize($_SESSION['logged']);
			  if($login == "admin"){
			  $_SESSION['admin'] = serialize($_SESSION['logged']);
			  }
			  header("Location: index.php");
		}
		return $message;
	}
	
	public function zarejestruj($dane)
	{
		$login = $dane->zwrocLogin();
		$pass = $dane->zwrocHaslo();
		$mail = $dane->zwrocMail();
		$date = $dane->zwrocDate();
		
		require_once('classes/db_connect.inc');
            
		$query = "SELECT * FROM Users WHERE Login='$login'";
        if(!$result = mysql_query($query))
		{
			echo '<code>$query</code> &rarr; '.mysql_error().' ('.mysql_errno().')';
			
		}
		if(mysql_num_rows($result)==0){
		}else {
			return 'Taki login już istnieje!';
		}
		
		$query = "SELECT * FROM Users WHERE Mail='$mail'";
        if(!$result = mysql_query($query))
		{
			echo '<code>$query</code> &rarr; '.mysql_error().' ('.mysql_errno().')';
			
		}
		if(mysql_num_rows($result)==0){
			$query = "INSERT INTO Users (Login, Password, Mail, Birthday) VALUES ('$login', '$pass','$mail', '$date');";
			$result = @mysql_query($query);
			if($result){
				return "Zarejestrowano";
				}else return "Wystąpił błąd";
		}else {
			return 'Taki mail już istnieje!';
		}
	}
	public function wszystkieGalerie($sort,$strona){
		require_once('db_connect.inc');
		$limit=0;
		if($strona!=0){
		$limit = 5*$strona;
		}
	$query = "SELECT * FROM galery ORDER BY ".$sort." ASC LIMIT ".$limit.",5;";
	$result = @mysql_query($query);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	
	return $return;
	}
	
	
	public function galerieKategoria($kategoria,$sort,$strona){
		require_once('db_connect.inc');
		$limit=0;
		if($strona!=0){
		$limit = 10*$strona;
		}
	$query = "SELECT * FROM galery WHERE Kategoria='$kategoria' ORDER BY ".$sort." ASC LIMIT ".$limit.",10 ;";
	$result = @mysql_query($query);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	return $return;
	}
	
	}
	

?>