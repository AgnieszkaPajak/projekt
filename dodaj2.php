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
				include("kategorie.php");
				?>
				</section>
				<section id="loguj">
			<div id="opis">
			<?php
if(isset($_GET['nazwa'])){
$galeria = $_GET['galeria'];	
			?>
			<form action="dodaj3.php?galeria=<?php echo $galeria; ?>&nazwa=<?php echo $_GET['nazwa']; ?>" method="POST">
			Podaj lokalizację zdjęcia <?php echo $_GET['nazwa']; ?>:<br/>
			<input type="text" name="lok" value=""/>
			<input type="submit" name="wykonaj" value="Wyślij" class="greenButton"/>
			<?php
			
	
}else{


?>

            
            
		
			<h1>Dodaj lokalizacje zdjęć</h1>
				<?php
				$foldery = array();
				$k=0;
				$galeria = $_GET['galeria'];
					$galerie = unserialize($_SESSION['serial'])->zdjeciaZGalerii($_SESSION['login'],$galeria);
					if($galerie!=null){
					?>
				
				<table id="gal">
				<tr>
				<td>Nazwa</td>
				<td>Galeria</td>
				<td>Autor</td>
				<td>Dodaj lokalizację</td>
				</tr>
				<?php
					$nazwa='';
					$lok="";
					foreach($galerie as $gal){
						echo '<tr>';						
						for($i=1;$i<5;$i++){
						if($i!=3){
						
							echo '<td>';
							$tmp = $gal[$i];
							echo $tmp;
							echo '</td>';
							if($i==1){
								$nazwa=$tmp;
							}
							
						}else {$lok = $gal[$i];}
						}
						?>
						<td><?php
							if($lok==""){
							?>
							<a href="dodaj2.php?galeria=<?php echo $galeria; ?>&nazwa=<?php echo $nazwa; ?>">
							 Dodaj </a><?php
							 }
							 else {echo $lok; }
							 ?></td></tr>
						
						<?php
						
					}
					?>
					
					<?php
					}else{
						echo '<br/>Brak galerii <br/>';
					}
				?>
	</table>
	<?php
	}
	?>
	<form action="index.php">
					<input type="submit" value="Koniec" class="greenButton"/>
					</form>
	</div>
            </section>
            
            
            <!-- koniec container-->
        </div>
    </body>
</html>
