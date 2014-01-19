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
		
			<h1>Zmień lokalizację zdjęć z galerii
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
	?>
	<form action="zmienL.php?galeria=<?php echo $galeria; ?>&nazwaZ=<?php echo $zdjecie; ?>&data=<?php echo $data; ?>" method="post">
	<input type="text" name="lok"/>
	<input type="submit" name="zmiana" class="greenButton" value="Lokalizacja"/>
	</form>
	<?php
	}
	if(isset($_POST['zmiana'])){
	$zmiana = $_POST['lok'];
	$log = unserialize($_SESSION['data'])->zwrocLogin();
	$galeria = $_GET['galeria'];
	$zdjecie = $_GET['nazwaZ'];
	$data = $_GET['data'];
	$string = $zmiana;
   $string = strtolower($string);
        $polskie = array(',', ' - ',' ','ę', 'Ę', 'ó', 'Ó', 'Ą', 'ą', 'Ś', 's', 'ł', 'Ł', 'ż', 'Ż', 'Ź', 'ź', 'ć', 'Ć', 'ń', 'Ń','-',"'","/","?", '"', ":", 'ś', '!','.', '&', '&amp;', '#', ';', '[',']','domena.pl', '(', ')', '`', '%', '”', '„', '…');
        $miedzyn = array('-','-','-','e', 'e', 'o', 'o', 'a', 'a', 's', 's', 'l', 'l', 'z', 'z', 'z', 'z', 'c', 'c', 'n', 'n','-',"","","","","",'s','','', '', '', '', '', '', '', '', '', '', '', '', '');
        $string = str_replace($polskie, $miedzyn, $string);
        
        // usuń wszytko co jest niedozwolonym znakiem
        $string = preg_replace('/[^0-9a-z\-]+/', '', $string);
        
        // zredukuj liczbę myślników do jednego obok siebie
        $string = preg_replace('/[\-]+/', '-', $string);
        
        // usuwamy możliwe myślniki na początku i końcu
        $string = trim($string, '-');

        $string = stripslashes($string);
        
        // na wszelki wypadek
        $string = urlencode($string);
	unserialize($_SESSION['serial'])->zmienLokalizacje($galeria,$zdjecie,$log,$string);
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
				<td>Lokalizacja</td>
				<td> </td>
				</tr>
				<?php
					$nazwa='';
					foreach($galerie as $gal){
						echo '<tr>';						
						for($i=1;$i<5;$i++){
						if($i!=4 && $i!=2){
						
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
							<a href="zmienL.php?galeria=<?php echo $galeria; ?>&nazwaZ=<?php echo $nazwa; ?>&data=<?php echo $data; ?>">Zmień</a></td></tr>
						
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
