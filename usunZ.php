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
		
			<h1>Usuń zdjęcia z galerii 
			<?php 
			if (isset($_GET['galeria'])) { 
				echo $_GET['galeria']; }
			else {
				echo $_GET['nazwa'];
			} 
			?>
			</h1>
			<?php
if (isset($_GET['galeria'])) {
 include_once('classes/dane.inc');
    $log = unserialize($_SESSION['data'])->zwrocLogin();
	$galeria = $_GET['galeria'];
	$zdjecie = $_GET['nazwaZ'];
	$data = $_GET['data'];
	$folder = $galeria.$data.'/';
	unserialize($_SESSION['serial'])->usunZdjecie($galeria,$zdjecie,$log,$folder);
    echo "<br/><br/>";
	
}

?>

            
            
<?php
				$foldery = array();
				$k=0;
				$galeria = '';
				if (isset($_GET['galeria'])) { 
				$galeria = $_GET['galeria']; }
			else {
				$galeria = $_GET['nazwa'];
			} 
			$data = $_GET['data'];
					$galerie = unserialize($_SESSION['serial'])->zdjeciaZGalerii($_SESSION['login'],$galeria);
					if($galerie!=null){
					?>
				
				<table id="gal">
				<tr>
				<td>Nazwa</td>
				<td>Autor</td>
				<td> </td>
				</tr>
				<?php
					$nazwa='';
					foreach($galerie as $gal){
						echo '<tr>';						
						for($i=1;$i<5;$i++){
						if($i!=3 && $i!=2){
						
							echo '<td>';
							$tmp = $gal[$i];
							echo $tmp;
							echo '</td>';
							if($i==1){
								$nazwa=$tmp;
							}
							
						}
						}
						?>
						<td>
							<a href="usunZ.php?galeria=<?php echo $galeria; ?>&nazwaZ=<?php echo $nazwa; ?>&data=<?php echo $data; ?>">Usuń</a></td></tr>
						
						<?php
						
					}
					?>
					
					<?php
					}else{
						echo '<br/>Brak galerii <br/>';
					}
				?>
	</table>
	
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
