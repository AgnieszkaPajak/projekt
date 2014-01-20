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
$_SESSION['user'] = new User();
?>
</head>
<body>
<header>Galery on map <h1> &copy Agnieszka Pająk</h1></header>
        <div id="container">
            <section id="menu">
               <?php
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
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'].'<br>';
                }

$message= '';
if(isset($_POST['login'])) {
	$message = '';
	if($_POST['login'] == '' || $_POST['password'] == '') {
		$message .= 'Podaj login i hasło';
	} else {
                
               
                
		$message .= $_SESSION['user']->zaloguj($_POST['login'], $_POST['password']);
		$_SESSION['login']=$_POST['login'];
        $_SESSION['message']=$message;
		if($message!='Poprawnie zalogowano'){
		unset($_SESSION['logout']);
		header("Location: index.php");}
                
	}
	}
	
?>
<h1>Zaloguj się</h1>
<form action="login.php" method="post">
			Login: <input type="text" name="login" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>" /><br />
			Hasło:	<input type="password" name="password" value="" /><br />
			<input type="submit" name="loguj" class="greenButton" value="Zaloguj" />
			<?php if($message=='Błędny login lub hasło') {echo '<br/>'.$message; $_SESSION['login']=null;}?>
    </form>
	</div>
	</section>

</div>

</body>
</html>