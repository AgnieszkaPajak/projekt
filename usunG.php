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
				</section>
				<?php
			include("kategorie.php");
			?>
            <section id="loguj">
			<div id="opis">
		
			<h1>Usuń galerię 
			<?php 
	
				echo $_GET['nazwa'];

			?>
			</h1>
			<?php
if (isset($_POST['usun'])) {
 include_once('classes/dane.inc');
    $log = unserialize($_SESSION['data'])->zwrocLogin();
	$galeria = $_GET['nazwa'];
	$data = $_GET['data'];
	$folder = $log.'/'.$galeria.$data.'/';
	unserialize($_SESSION['serial'])->usunGalerie($galeria,$log,$folder);
    header("Location: galeries.php");
	
}else if(isset($_POST['wroc'])){
header("Location: galeries.php");
}

?>

       Czy na pewno chcesz usunąć galerię <?php echo $_GET['nazwa']; ?>? Wszystkie zdjęcia z tej galerii stracisz bezpowrotnie!<br/>
	   <form action="usunG.php?nazwa=<?php echo $_GET['nazwa']; ?>&data=<?php echo $_GET['data']; ?>" method="post">
	   <input type="submit" name="usun" value="Usuń" class="greenButton" />
	   <input type="submit" name="wroc" value="Wróć" class="greenButton" />
	
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
