<?php
class LoggedUser extends User {

    private $id;
    public function __construct($id) {
        parent::__construct();
        $this->id = $id;
    }

 
	public function getId(){
		return $this->id;
	}
	public function wyloguj(){
	include_once('user.inc');
		
		if(isset($_SESSION['logged'])){
			$_SESSION['logged'] = null;
			session_destroy();
			return 'Poprawnie wylogowano';
		}
	}
	
	public function dodaj($login){
		require_once('db_connect.inc');
		$nazwa = $_POST['nazwa'];
		$ilosc = count($_FILES['obrazek']['name']);		
		$date = date('Y-m-d');
		$folder = $nazwa.$date;
		$kategoria = $_POST['kategorie'];
		
		$f = $login.'/'.$folder;
		$query = "INSERT INTO galery (Autor, Nazwa, Ilosc, Folder, Data, Kategoria) VALUES ('$login', '$nazwa','$ilosc','$f', '$date','$kategoria');";
        $result = @mysql_query($query);
		
		$q = "SELECT NoGaleries FROM users WHERE Login='$login';";
		$r = @mysql_query($q);
		$noGal = 0;
		while ($row = mysql_fetch_array($r, MYSQL_NUM)) {
			$noGal=$row[0];
		}
		$noGal++;
		$query = "UPDATE users SET NoGaleries='$noGal' WHERE Login='$login';";
		$result2 = @mysql_query($query);
		
		$q = "SELECT IloscGalerii FROM categories WHERE Nazwa='$kategoria';";
		$r = @mysql_query($q);
		$noKat = 0;
		while ($row = mysql_fetch_array($r, MYSQL_NUM)) {
			$noKat=$row[0];
		}
		$noKat++;
		$query = "UPDATE categories SET IloscGalerii='$noKat' WHERE Nazwa='$kategoria';";
		$result3 = @mysql_query($query);
		
        if ($result && result2 & $result3) {			
            echo 'Dodano galerię.';
        } else {
            echo 'Wystąpił błąd.';
        }
				return $folder;
	}
	function sprawdz_bledy()
{
  if ($_FILES['obrazek']['error'] > 0)
  {
    echo 'problem: ';
    switch ($_FILES['obrazek']['error'])
    {
      // jest większy niż domyślny maksymalny rozmiar,
      // podany w pliku konfiguracyjnym
      case 1: {echo 'Rozmiar pliku jest zbyt duży.'; break;} 
	  
      // jest większy niż wartość pola formularza 
      // MAX_FILE_SIZE
      case 2: {echo 'Rozmiar pliku jest zbyt duży.'; break;}
	  
      // plik nie został wysłany w całości
      case 3: {echo 'Plik wysłany tylko częściowo.'; break;}
	  
      // plik nie został wysłany
      case 4: {echo 'Nie wysłano żadnego pliku.'; break;}
	  
      // pozostałe błędy
      default: {echo 'Wystąpił błąd podczas wysyłania.';
        break;}
    }
    return false;
  }
  return true;
}
public function zwrocIloscGalerii($login){
	require_once('db_connect.inc');
	$q = "SELECT NoGaleries FROM users WHERE Login='$login';";
	$result = @mysql_query($q);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return = $row[0];
	}
	return $return;
}
function sprawdz_typ()
{
	if ($_FILES['obrazek']['type'] != 'image/jpg')
		return false;
	return true;
}

function zapisz_plik($lokalizacja,$galeria)
{

    $file_count = count($_FILES['obrazek']['name']);
	$_SESSION['iloscZ'] = $file_count;
    $tmp = $lokalizacja;
	if(!is_dir($_SESSION['login'])){
		mkdir($_SESSION['login'],0777);
	}
	if(!is_dir($_SESSION['login'].'/'.$lokalizacja)){
	 mkdir($_SESSION['login'].'/'.$lokalizacja,0777);
	 }
	 $adres = $_SESSION['login'].'/'.$lokalizacja.'/min/';
	 if(!is_dir($adres)){
	mkdir($adres,0777);
	}
	for($i=0; $i<$file_count; $i++) {
	$lokalizacja = $_SESSION['login'].'/'.$tmp;
	$lok='./';
	$plik_nazwa = $_FILES['obrazek']['name'][$i];  
    $lokalizacja = $lokalizacja.'/'.$plik_nazwa;
	$lok=$lok.$lokalizacja;
	require_once('db_connect.inc');
  if(is_uploaded_file($_FILES['obrazek']['tmp_name'][$i]))
  {
    if(!move_uploaded_file($_FILES['obrazek']['tmp_name'][$i], $lok))
    {
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
        return false;  
    }
	$login = $_SESSION['login'];
	$query = "INSERT INTO zdjecie (Autor, Nazwa, Galeria) VALUES ('$login', '$plik_nazwa','$galeria');";
	$result = @mysql_query($query);
	$save_file = $lok;
	$img = imagecreatefromjpeg(''.$save_file.'');
	$width  = imagesx($img);
	$height = imagesy($img);
	
	$width_mini = 50; // szerokosc obrazka
	$height_mini = 50; // wysokosc obrazka
	$img_mini = imagecreatetruecolor($width_mini, $height_mini);
	imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_mini , $height_mini, $width  , $height);
	
	
	imagejpeg($img_mini, $_SESSION['login'].'/'.$tmp.'/min/min-'.$plik_nazwa."", 80); 
  }
  else
  {
    echo 'problem: Możliwy atak podczas przesyłania pliku.';
	echo 'Plik nie został zapisany.';
    return false;
  }
  }
	
  return true;
}

public function twojeGalerie($login){
	require_once('db_connect.inc');
	$query = "SELECT * FROM galery WHERE Autor = '$login'";
	$result = @mysql_query($query);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	return $return;
}

public function zdjeciaZGalerii($login, $galeria){
	require_once('db_connect.inc');
	$query = "SELECT * FROM zdjecie WHERE Autor = '$login' AND Galeria = '$galeria'";
	$result = @mysql_query($query);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	return $return;
}

public function dodajLokalizacje($log,$lokalizacja,$galeria,$nazwa){
	require_once('db_connect.inc');
	$query = "UPDATE zdjecie SET Lokalizacja='$lokalizacja' WHERE Autor='$log' AND Galeria='$galeria' AND Nazwa='$nazwa';";
	$result = @mysql_query($query);
	if ($result) {			
            echo 'Dodano lokalizację.';
        } else {
            echo 'Wystąpił błąd.';
        }
}

public function zwrocLokalizacje($log,$galeria,$nazwa){
	require_once('db_connect.inc');
	$query = "SELECT Lokalizacja FROM zdjecie WHERE Autor='$log' AND Galeria='$galeria' AND Nazwa='$nazwa';";
	$result = @mysql_query($query);
	$return = null;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	return $return;
}

public function dodajIloscZdjec($folder){
	require_once('db_connect.inc');
	$query = "SELECT Ilosc FROM galery WHERE Folder='$folder';";
	$result = @mysql_query($query);
	$il = 0;
	 while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$il = $row[0];
	 }
	$il = $il + $_SESSION['iloscZ'];
	$query = "UPDATE galery SET Ilosc='$il' WHERE Folder='$folder';";
	$result = @mysql_query($query);
}

public function usunZdjecie($galeria,$nazwa,$autor,$folder){
	require_once('db_connect.inc');
	$query = "DELETE FROM zdjecie WHERE Nazwa='$nazwa' AND Galeria='$galeria' AND Autor='$autor';";
	$result = @mysql_query($query);
	if ($result) {			
            echo 'Usunięto zdjęcie '.$nazwa.' z galerii '.$galeria;
			unlink($autor.'/'.$folder.$nazwa);
			unlink($autor.'/'.$folder.'min/min-'.$nazwa);
        } else {
            echo 'Wystąpił błąd.';
        }
}
	public function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }

public function usunGalerie($galeria,$log,$folder){
	require_once('db_connect.inc');
	$query = "DELETE FROM galery WHERE Nazwa='$galeria' AND Autor='$log';";
	$result = @mysql_query($query);
	if(!$result = mysql_query($query))
		{
			echo '<code>$query</code> &rarr; '.mysql_error().' ('.mysql_errno().')';

		}
	$query = "DELETE FROM zdjecie WHERE Galeria='$galeria' AND Autor='$log';";
	$result2 = @mysql_query($query);
	if ($result && $result2) {			
            echo 'Usunięto galerię '.$galeria;
			self::rrmdir($folder);
			$query="SELECT NoGaleries FROM users WHERE Login='$log';";
			$result = @mysql_query($query);
			$ilosc = 0;
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$ilosc = $row[0];
			 }
			 $ilosc = $ilosc-1;
			 if($ilosc>=0){
				$query = "UPDATE users SET NoGaleries='$ilosc' WHERE Login='$log';";
				$result = @mysql_query($query);
			 }
			 $this->updateCategories();
        } else {
            echo 'Wystąpił błąd.';
        }
	
}

public function updateCategories(){
require_once('db_connect.inc');
	$query = "SELECT Nazwa FROM categories;";
	$result = @mysql_query($query);
	$return = null;
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return[] = $row;
	}
	$size = sizeof($return);
	for($i=0;$i<$size;$i++){
	$tmp = $return[$i][0];
			$query = "SELECT COUNT(*) as count FROM galery WHERE Kategoria='$tmp';";
			$result = @mysql_query($query);
			$il =0;
			 while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$il = $row[0];
				
			 }
			 $query = "UPDATE categories SET IloscGalerii = '$il' WHERE Nazwa='$tmp';";
			 $result = @mysql_query($query);
			 if(!$result){
				echo "Błąd w zliczaniu galerii!";
			 }
		
	}
}

public function usunKonto($log,$has){
	require_once('db_connect.inc');
	$pass = SHA1($has);
	$query = "SELECT * FROM users WHERE Login='$log' AND Password='$pass';";
	$result = mysql_query($query);
	if(mysql_num_rows($result)==0){
		echo "Błędne hasło!";
	}else{
	$query = "DELETE FROM users WHERE Login='$log' AND Password='$pass';";
	$result = @mysql_query($query);
	$query = "DELETE FROM galery WHERE Autor='$log';";
	$result2 = @mysql_query($query);
	$query = "DELETE FROM zdjecie WHERE Autor='$log';";
	$result3 = @mysql_query($query);
	if ($result && $result2 && $result3) {			
            echo 'Usunięto konto '.$log;
			$this->rrmdir($log);
        } else {
            echo 'Wystąpił błąd.';
        }
	$this->updateCategories();
	}
	$this->wyloguj();
}
public function zmienLokalizacje($galeria,$zdjecie,$log,$zmiana){
	require_once('db_connect.inc');
	$query = "UPDATE zdjecie SET Lokalizacja='$zmiana' WHERE Autor='$log' AND Galeria='$galeria' AND Nazwa='$zdjecie';";
	$result = @mysql_query($query);
	if ($result) {			
            echo 'Zmieniono lokalizację.';
        } else {
            echo 'Wystąpił błąd.';
        }
}

public function dodajKategorie($kategoria){
	require_once('db_connect.inc');
	$query = "SELECT Nazwa FROM categories WHERE Nazwa='$kategoria';";
	$result = @mysql_query($query);
	if(mysql_num_rows($result)!=0){
		echo "Taka kategoria już istnieje!";
	}else{
		$query = "INSERT INTO categories (Nazwa, IloscGalerii) VALUES ('$kategoria', 0);";
		$result = @mysql_query($query);
		if($result){
			echo "Dodano kategorię ".$kategoria;
		}else{
			echo "Error.";
		}
	}
		
}

public function usunKategorie($kategoria){
if($kategoria!="Bez kategorii"){
	require_once('db_connect.inc');
	$query = "SELECT Nazwa FROM categories WHERE Nazwa='$kategoria';";
	$result = @mysql_query($query);
	if(mysql_num_rows($result)==0){
		echo "Taka kategoria nie istnieje!";
	}else{
		$str = "Bez kategorii";
		$query = "UPDATE galery SET Kategoria='$str' WHERE Kategoria='$kategoria';";
		$result = @mysql_query($query);
		$query = "DELETE FROM categories WHERE Nazwa='$kategoria';";
		$result = @mysql_query($query);
		if($result){
		
		echo "Usunięto kategorię ".$kategoria;
		
		}else{
			echo "Error.";
		}
	}
	}else {
	echo "Tej kategorii nie można usunąć!";
	}
		
}

}//koniec class
?>