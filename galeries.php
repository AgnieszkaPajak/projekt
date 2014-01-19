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
            <h1>Galerie</h1>
			<?php
			if (isset($_SESSION['logged'])) { 
				?>
				<a href="dodaj.php" class="guzik">Dodaj galerię</a><br/>
				<div class="gal">
				<h1>Twoje galerie</h1>
				<?php
				$foldery = array();
					$galerie = unserialize($_SESSION['serial'])->twojeGalerie($_SESSION['login']);
					if($galerie!=null){
					?>
				
				<table class="tabgal">
				<tr>
				<td>Nazwa</td>
				<td>Ilość zdjęć</td>
				<td>Folder galerii</td>
				<td>Data</td>
				<td>Kategoria</td>
				<td>Zobacz</td>
				<td>Dodaj zdjęcia</td>
				<td>Zmień lokalizacje</td>
				<td>Usuń zdjęcia</td>
				<td>Usuń galerię</td>
				
				</tr>
				<?php
					$j=0;
					$k=0;
					
					foreach($galerie as $gal){
						echo '<tr>';
						$nazwa='';
						$data='';
						$lok='';
						for($i=2;$i<7;$i++){
							echo '<td>';
							$tmp = $gal[$i];
							echo $tmp;
							echo '</td>';
							if($i==4){
								$foldery[$j]=$tmp;
								$j++;
							}
							if($i==2){
								$nazwa= $tmp;
							}
							if($i==5){
								$data= $tmp;
							}
							}
						echo '<td>';
						echo '<a href=zaznacz.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a>';
						echo '</td><td><a href=dodajZ.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a></td>';
						echo '<td><a href=zmienL.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a></td>';
						echo '<td><a href=usunZ.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a></td>';
						echo '<td><a href=usunG.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a></td>';
						
						echo '</tr>';
						$k++;
					}
					}else{
						echo '<br/>Brak galerii <br/>';
					}
				?>
				
				</table>
				</div>
				<?php
				
				$strona=0;
				$_SESSION['page']=$strona;
				if(isset($_GET['backpage'])){
					$strona = $_SESSION['backpage'];
					unset($_SESSION['backpage']);
				}else{
				if(isset($_GET['page'])){
					$_SESSION['page'] = $_GET['page'] +1;
				}
				if(isset($_SESSION['page'])){
					$strona= $_SESSION['page'];
				}}
				
				?>
				<h1>Przeglądaj</h1>
				<div class="gal">
				<?php
				$galerie = unserialize($_SESSION['serial'])->wszystkieGalerie("Nazwa",$strona);
				if(isset($_GET['sort'])){
				$sort = $_GET['sort'];
				$galerie = unserialize($_SESSION['serial'])->wszystkieGalerie($sort,$strona);
				}
				
				
					
					?>
				<i>Kliknij aby posortować</i><br/><br/>
				<table class="tabgal">
				<tr>
				<?php 
				$tmpp = $strona -1;
				
				?>
				<td><a href="galeries.php?sort=Autor&page=<?php echo $tmpp; ?>">Autor</a></td>
				<td><a href="galeries.php?sort=Nazwa&page=<?php echo $tmpp; ?>">Nazwa galerii</a></td>
				<td><a href="galeries.php?sort=Ilosc&page=<?php echo $tmpp; ?>">Ilość zdjęć</a></td>
				<td><a href="galeries.php?sort=Data&page=<?php echo $tmpp; ?>">Data utworzenia</a></td>
				<td><a href="galeries.php?sort=Kategoria&page=<?php echo $tmpp; ?>">Kategoria</a></td>
				<?php
				if(isset($_SESSION['admin'])){
						echo '<td>Usuń galerię</td>';
				}
				?>
				<td>Zobacz</td>
				</tr>
				
				<?php
				$j=0;
				if($galerie!=null){
					foreach($galerie as $gal){
						echo '<tr>';
						$nazwa='';
						$data='';
						$autor='';
						
						for($i=1;$i<7;$i++){
						if($i==4){
							continue;
							}
							echo '<td>';
							$tmp = $gal[$i];
							echo $tmp;
							echo '</td>';
							if($i==1){
								$autor = $tmp;
							}
							if($i==2){
								$nazwa= $tmp;
							}
							if($i==5){
								$data= $tmp;
							}
						}
						
				if(isset($_SESSION['admin'])){
						echo '<td><a href=usunG.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '>>></a></td>';
				}
				
						echo '<td><a href=zaznacz.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '&autor=';
						echo $autor;
						echo '>>></a></td>';
						
						echo '</tr>';
					}
				}
				?>
				</table><br/><br/>
				<?php
				
				if( $strona >=1){
				$_SESSION['backpage'] = $strona-1;
				?>
				<a href="galeries.php?backpage=<?php echo $_SESSION['backpage']; ?>" class="guzikFlip">Poprzednia</a>
				<?php
				}
				echo "<i>strona ".$strona."</i>";
				?>
				<a href="galeries.php?page=<?php echo $strona; ?>" class="guzik">Następna</a>
				</div>
				<?php
			
			}
			
			?>
			</div>
			
            </section>
            
            <!-- koniec container-->
        </div>
    </body>
</html>
