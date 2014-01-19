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
				
?>

            </section>
            <?php
			include("kategorie.php");
			?>
            <section id="opis">
            Witam na stronie!<br>
            Serdecznie zapraszam do przeglądania publicznych galerii.<br>
            Po rejestracji możliwe jest dodawanie własnych zdjęć wraz z ich lokalizacjami.<br>
			
            <div id="results"></div>
            </section>
            <section id="galeria">
                <h1>Przykładowa galeria</h1>
				<?php
				$k=0;
				$nazwaGal = "przykladowa";
				$nazwa = "./admin/przykladowa2014-01-05/";
                $d = dir($nazwa);
				$i=0;
				include_once('classes/dane.inc'); 
				include('classes/user.inc');	  
				include('classes/loggeduser.inc');
				$log = "admin";
				$tablica = Array();
				$tabLok = Array();
				$admin = new LoggedUser(99999);
				while (false !== ($entry = $d->read())) {
					if ($entry != '.' && $entry != '..' && $entry!='min'){
					$tabLok[$k] = $admin->zwrocLokalizacje($log,$nazwaGal,$entry);
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
                <div id="search">
                    <input type="text" name="addr" value="" id="addr" size="10" />
                    <button type="button" onclick="addr_search();" class="greenButton">Szukaj na mapie</button>

                </div>

            </section>
            
            <!-- koniec container-->
        </div>
    </body>
</html>
