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
        <header>Individual project <h1> &copy Agnieszka Pająk</h1></header>
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
            <h1>Usuń kategorię</h1>
			<form action="usunKat.php" method="post">
			<select name="kategorie">
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
			</select>
			<input type="submit" name ="usun" class="greenButton" value="Usuń"/>
			</form>
				<?php
				if(isset($_POST['usun'])){
				$kategoria = $_POST['kategorie'];
				unserialize($_SESSION['serial'])->usunKategorie($kategoria);
				}
					?>
			 </div>
            </section>
            
            <!-- koniec container-->
       
    </body>
</html>
