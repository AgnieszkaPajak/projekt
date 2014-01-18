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
	  ob_start();
		?>



    </head>
    <body>
        <header>Individual project <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
				if (!isset($_SESSION['logged'])) { 
					include("nav.php");
				} else include("navlogged.php");
?>

            </section>
            <?php
			include("kategorie.php");
			?>
            <section id="opis">
			
			<a href="zmienHaslo.php" class="zmien">Zmień hasło</a>
			
			<div id="dane">
           <b> Dane użytkownika</b><br><br>
            Login: <?php
			include_once('classes/dane.inc');
			echo unserialize($_SESSION['data'])->zwrocLogin();			
			?>
			<br>
			Data urodzenia: <?php
			echo unserialize($_SESSION['data'])->zwrocDate();	
				?><br>
			Mail: <?php
			echo unserialize($_SESSION['data'])->zwrocMail();	
			?>
			<br>
            Ilość galerii: <?php
			$login=$_SESSION['login'];
			$ilosc[] = unserialize($_SESSION['serial'])->zwrocIloscGalerii($login);	
			echo $ilosc[0];
			?><br>
            </div>
			<a href="zmienDane.php" class="zmien">Zmień dane</a>
            </section>
            <section id="loguj">			
			<a href="usunKonto.php" class="guzik">Usuń konto</a>
			</section>
            
            <!-- koniec container-->
        </div>
    </body>
</html>
