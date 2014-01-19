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
        <header>Individual project <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
			   include_once('classes/dane.inc');
				if (!isset($_SESSION['logged'])) { 
					include("nav.php");
				} else include("navlogged.php");
				
				
if (isset($_POST['wyslano'])) {
 include_once('classes/dane.inc');
    $log = unserialize($_SESSION['data'])->zwrocLogin();
    $has = unserialize($_SESSION['data'])->zwrocHaslo();
    unserialize($_SESSION['data'])->zmienDane($log, $has);
    echo "<br/><br/>";
}

?>

            </section>
            <?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
		
			<h1>Zmień dane</h1>

<form action="zmienDane.php" method="POST" id="formularz">
    <table>
    <tr>
    <td>Login:</td>
    <td><input type="text" size='25' name="log" value="<?php echo unserialize($_SESSION['data'])->zwrocLogin(); ?>"/><br /></td>
    </tr>
    <tr>
    <td>Mail:</td>
    <td><input type="text" size='25' name="mail" value="<?php echo unserialize($_SESSION['data'])->zwrocMail(); ?>"/><br /></td>
    <tr>
    <td><br />Data urodzenia:</td>
    <td><br /><input type="date" name="data_urodzenia" value="<?php echo unserialize($_SESSION['data'])->zwrocDate(); ?>" /><br /></td>
    </tr>
	</table>    
    <br /><input type="submit" value="Wyślij" name="wyslano" class="greenButton"/></form>
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
