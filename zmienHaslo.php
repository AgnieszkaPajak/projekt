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
 if($_POST['new']==$_POST['new1']){
    $log = unserialize($_SESSION['data'])->zwrocLogin();
    $has = $_POST['haslo'];
    unserialize($_SESSION['data'])->zmienHaslo($log, $has);
    echo "<br/><br/>";}else {echo 'nowe hasła się różnią';
	}
}

?>

            </section>
            <?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
		
			<h1>Zmień hasło</h1>

<form action="zmienHaslo.php" method="POST" id="formularz">
    <table>
    <tr>
    <td>Stare hasło:</td>
    <td><input type="password" size='25' name="haslo" value=""/><br /></td>
    </tr>
    <tr>
    <td>Nowe hasło:</td>
    <td><input type="password" size='25' name="new" value=""/><br /></td>
    <tr>
    <td><br />Powtórz hasło:</td>
    <td><br /><input type="password" name="new1" value="" /><br /></td>
    </tr>
	</table>    
    <br /><input type="submit" value="Wyślij" name="wyslano" class="greenButton"/></form>
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
