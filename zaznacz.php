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
		<script src="lightbox/js/jquery-1.10.2.min.js"></script>
		<script src="lightbox/js/lightbox-2.6.min.js"></script>
		<link href="lightbox/css/lightbox.css" rel="stylesheet" />
		
		
        <script type="text/javascript">
            $(document).ready(function(){
                $('#pokazKat').click(function(){
                $("#kategorie").slideToggle();
            });
				
        });

		function SetElement(valueToSelect)
{    
    var element = document.getElementById('addr');
    element.value = valueToSelect;
}
var k=0;
var ikonka = new Array();
var miasta = new Array();
        </script>
      



    </head>
    <body onload="initmap([50.0297212, 19.91294]);">
        <header>Galery on map <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
			   session_start();
				if (!isset($_SESSION['logged'])) { 
					include("nav.php");
				} else include("navlogged.php");
				
				$k=0;
?>

            </section>
            <?php
			include("kategorie.php");
			?>
            
            <section id="galeria">
                <h1><?php
				$nazwaGal = $_GET['nazwa'];
				echo $nazwaGal;
				echo '<br/>Z dnia: ';
				echo $_GET['data'];
				$nazwa=null;
				if(isset($_GET['autor'])){
				$nazwa = "./".$_GET['autor'].'/'.$_GET['nazwa'].$_GET['data'];
				}else
				{$nazwa = "./".$_SESSION['login'].'/'.$_GET['nazwa'].$_GET['data'];}
				
				$d = dir($nazwa);
				$i=0;
				include_once('classes/dane.inc'); 
				include('classes/user.inc');	  
				include('classes/loggeduser.inc');
				if(isset($_GET['autor'])){
				$log = $_GET['autor'];}
				else{
				$log = unserialize($_SESSION['data'])->zwrocLogin();
				}
				$tablica = Array();
				$tabLok = Array();
				?>
				</h1>
			
                
                    
					<?php
					while (false !== ($entry = $d->read())) {
					if ($entry != '.' && $entry != '..' && $entry!='min'){
					if(isset($_SESSION['serial'])){
					$tabLok[$k] = unserialize($_SESSION['serial'])->zwrocLokalizacje($log,$nazwaGal,$entry);
					}else{
					$notlogged = new LoggedUser(-1);
					$tabLok[$k] = $notlogged->zwrocLokalizacje($log,$nazwaGal,$entry);
					}
					$tablica[$k]=$entry;
					?>
					<script type='text/javascript'> ikonka[k] = "<?php echo $nazwa; ?>/min/min-<?php echo $entry; ?>"; 
					miasta[k] = "<?php echo $tabLok[$k][0][0]; ?>";
					</script>
                        
                        <script type='text/javascript'>k=k+1;</script>
						
                    <?php
					$k++;
					
				 }
				}
				$d->close();
				?>
				<table id="galeria1"><tr>
				<?php
					for($i=0;$i<$k;$i++){
						?>
						<td><a data-lightbox="image-1" href="<?php
						echo $nazwa;
						echo '/';
						echo $tablica[$i]; ?>"  onclick="SetElement(miasta[<?php echo $i; ?>]);zaznacz(ikonka[<?php echo $i; ?>]);"><img width="50px" height="50px" src=<?php
						echo $nazwa;
						echo '/';
						echo $tablica[$i];
						?>
						alt="Kliknij, aby wyświetlić lokalizację" /></a></td>
						
						<?php
						if($i%5==0 && $i>=5){
							echo '</tr><tr>';
						}
						if($k<5){
							if($i==$k){
								echo '</tr><tr>';
							}
						}
					}
				?>
				</tr>
                </table>
				
            </section>

            <section id="mapa">
                <h1>Lokalizacja</h1>
                <div id="map"></div>
                <div id="hidden">
                    <input type="text" name="addr" value="<?php echo $_GET['lok']; ?>" id="addr" size="10" />

                </div>

            </section>
            <!-- <div id="results"></div> -->
            <!-- koniec container-->
        </div>
    </body>
</html>
