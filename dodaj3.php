	<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <title>Galeria na mapie</title>
        <link rel="stylesheet" href="leaflet.css" />
                    <!--[if lte IE 8]>
                                     <link rel="stylesheet" href="leaflet.ie.css" />
                                 <![endif]-->
        <link rel="stylesheet" href="style.css" />
        <script src="leaflet.js"></script>
        <script src="Script.js"></script>
        <script src="jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#pokazKat').click(function(){
                $("#kategorie").slideToggle();
            });
 
        });

        </script>
      <?php
	  session_start();
	  include('classes/user.inc');	  
	  include('classes/loggeduser.inc');
		?>



    </head>
    <body>
        <header>Galery on map <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
			   include_once('classes/dane.inc');
				if (!isset($_SESSION['logged'])) { 
					include("nav.php");
				} else include("navlogged.php");
				include("kategorie.php");
				$galeria = $_GET['galeria'];
				?>
				</section>
				<section id="loguj">
			<div id="opis">
			<?php
if (isset($_GET['nazwa'])) {
 include_once('classes/dane.inc');	
    $log = unserialize($_SESSION['data'])->zwrocLogin();
		
	$nazwa = $_GET['nazwa'];
	$lokalizacja = $_POST['lok'];
	$string = $lokalizacja;
   $string = strtolower($string);
        $polskie = array(',', ' - ',' ','ę', 'Ę', 'ó', 'Ó', 'Ą', 'ą', 'Ś', 's', 'ł', 'Ł', 'ż', 'Ż', 'Ź', 'ź', 'ć', 'Ć', 'ń', 'Ń','-',"'","/","?", '"', ":", 'ś', '!','.', '&', '&amp;', '#', ';', '[',']','domena.pl', '(', ')', '`', '%', '”', '„', '…');
        $miedzyn = array('-','-','-','e', 'e', 'o', 'o', 'a', 'a', 's', 's', 'l', 'l', 'z', 'z', 'z', 'z', 'c', 'c', 'n', 'n','-',"","","","","",'s','','', '', '', '', '', '', '', '', '', '', '', '', '');
        $string = str_replace($polskie, $miedzyn, $string);
        
        // usuń wszytko co jest niedozwolonym znakiem
        $string = preg_replace('/[^0-9a-z\-]+/', '', $string);
        
        // zredukuj liczbę myślników do jednego obok siebie
        $string = preg_replace('/[\-]+/', '-', $string);
        
        // usuwamy możliwe myślniki na początku i końcu
        $string = trim($string, '-');

        $string = stripslashes($string);
        
        // na wszelki wypadek
        $string = urlencode($string);
    $lok = unserialize($_SESSION['serial'])->dodajLokalizacje($log,$string,$galeria,$nazwa);	
    echo "<br/><br/>";
	?>
	
	<?php
	}
				?>
				
<a href="dodaj2.php?galeria=<?php echo $galeria; ?>">Wróć</a>

	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
