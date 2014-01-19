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
				?>
				</section>
				<?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
		
			<h1>Usuń swoje konto - Wszystkie galerie zostaną usunięte! 
			
			</h1>
			<?php
if (isset($_GET['usun'])) {
if($_GET['usun']=='usun'){

	?>
	Dla bezpieczeństwa proszę podać swoje hasło:
	<form method="post" action="usunKonto.php?usun=haslo">
	<input type="password" name="haslo" value=""/>
	<input type="submit" value="OK" class="greenButton"/>
	</form>
	<?php
	}
if($_GET['usun']=='haslo'){
include_once('classes/dane.inc');
$log = unserialize($_SESSION['data'])->zwrocLogin();
$has = $_POST['haslo'];
	unserialize($_SESSION['serial'])->usunKonto($log,$has);
   
	}
}else{

?>  
			Czy na pewno chcesz usunąć swoje konto?<br/><br/>
			<a href="usunKonto.php?usun=usun" class="guzik" >USUŃ</a>
         
			<a href="index.php" class="guzik">Wróć</a>
<?php
}
?>
	
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
