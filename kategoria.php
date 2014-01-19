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
        <header>Galery on map <h1> &copy Agnieszka Pająk</h1></header>
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
			<div id="kat">
			
            <h1>Kategoria <?php echo $_GET['category']; ?></h1>
				<div class="gal">
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
				<?php
				$notlogged = new User();
				if(isset($_GET['sort'])){
				$sort = $_GET['sort'];
				if(isset($_SESSION['serial'])){
				$galerie = unserialize($_SESSION['serial'])->galerieKategoria($_GET['category'], $sort,$strona);
				}else{				
				$galerie = $notlogged->galerieKategoria($_GET['category'], $sort,$strona);
				}
				}else{
				if(isset($_SESSION['serial'])){
				$galerie = unserialize($_SESSION['serial'])->galerieKategoria($_GET['category'], "Nazwa",$strona);
				}else{
				$galerie = $notlogged->galerieKategoria($_GET['category'], "Nazwa",$strona);
				}
				}
					if($galerie!=null){
					?>
				<i>Kliknij aby posortować</i><br/><br/>
				<table class="tabgal">
				<tr>
				<td><a href="kategoria.php?sort=Autor&category=<?php echo $_GET['category']; ?>">Autor</a></td>
				<td><a href="kategoria.php?sort=Nazwa&category=<?php echo $_GET['category']; ?>">Nazwa galerii</a></td>
				<td><a href="kategoria.php?sort=Ilosc&category=<?php echo $_GET['category']; ?>">Ilość zdjęć</a></td>
				<td><a href="kategoria.php?sort=Data&category=<?php echo $_GET['category']; ?>">Data utworzenia</a></td>
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
						
						for($i=1;$i<6;$i++){
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
						echo '<td><a href=zaznacz.php?nazwa=';
						echo $nazwa;
						echo '&data=';
						echo $data;
						echo '&autor=';
						echo $autor;
						echo '>>></a></td>';
						
						echo '</tr>';
					}
				}else {echo "Brak galerii";}
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
			
			
			</div>
            </section>
            
            <!-- koniec container-->
        </div>
    </body>
</html>
