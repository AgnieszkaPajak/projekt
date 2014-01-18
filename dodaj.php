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
				?>
				</section><?php
if (isset($_POST['wyslano'])) {
 include_once('classes/dane.inc');
    $log = unserialize($_SESSION['data'])->zwrocLogin();
    $lok = unserialize($_SESSION['serial'])->dodaj($log);	
    unserialize($_SESSION['serial'])->sprawdz_typ();
    unserialize($_SESSION['serial'])->zapisz_plik($lok,$_POST['nazwa']);
    echo "<br/><br/>";
	$nazwa = $_POST['nazwa'];
	header("Location: dodaj2.php?galeria=$nazwa");
}

?>

            
            <?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
		
			<h1>Dodaj galerię</h1>

<form action="dodaj.php" method="POST" id="formularz" enctype="multipart/form-data">
    <table>
    <tr>
    <td>Nazwa galerii:</td>
    <td><input type="text" size='25' name="nazwa" value=""/><br /></td>
    </tr>
	<tr>
    <td>Kategoria:</td>
    <td><select name="kategorie">
	<?php
	include_once('classes/categories.inc');
		$categories = new Categories();
		$cat = $categories->getCategories();
		foreach($cat as $val){						
			$tmp = $val[0];
			?>
			<option><?php echo $tmp; ?></option>
			<?php
		}
		?>
	</select><br /></td>
    </tr>
    <tr>
    <td>Zdjęcia:</td>
    <td><input type="file" multiple name="obrazek[]"><br /></td>
    </tr>
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
	</table>    
    <br /><input type="submit" value="Wyślij" name="wyslano" class="greenButton"/></form>
	
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
