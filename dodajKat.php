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
      



    </head>
    <body onload="initmap([50.0297212, 19.91294]);">
        <header>Galery on map <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
			   session_start();
			   include('classes/user.inc');	  
				include('classes/loggeduser.inc');
				if (!isset($_SESSION['logged'])) { 
					include("nav.php");
				} else include("navlogged.php");
?>

            </section>
            <?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
            <h1>Dodaj kategorię</h1>
			<form action="dodajKat.php" method="post">
			Nazwa kategorii <input type="text" name="nazwa"/>
			<input type="submit" name ="dodaj" class="greenButton" value="Dodaj"/>
			</form>
				<?php
				if(isset($_POST['dodaj'])){
				$kategoria = $_POST['nazwa'];
				unserialize($_SESSION['serial'])->dodajKategorie($kategoria);
				}
					?>
			 </div>
            </section>
            
            <!-- koniec container-->
       
    </body>
</html>
