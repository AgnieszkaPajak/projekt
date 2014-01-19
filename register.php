<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <title>Galeria na mapie - rejestracja</title>
        <link rel="stylesheet" href="leaflet.css" />
                    <!--[if lte IE 8]>
                         <link rel="stylesheet" href="leaflet.ie.css" />
                     <![endif]-->
        <link rel="stylesheet" href="style.css" />
        <script src="leaflet.js"></script>
        <script src="Script.js"></script>
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
			$message= '';
			if(isset($_POST['login'])) {
				$message = '';
				if($_POST['login'] == '' || $_POST['password'] == '') {
					$message .= 'Podaj login i hasło';
				} else if($_POST['password'] == $_POST['pass2']){
					include_once('classes/dane.inc');
					$dane = new Dane($_POST['login'],sha1($_POST['password']));
					$dane->ustawMail($_POST['mail']);
					$dane->ustawDate($_POST['date']);
					$message = $_SESSION['user']->zarejestruj($dane);
					$_SESSION['message']=$message;
					if($message!='Poprawnie zarejestrowano'){
					//unset($_SESSION['logout']);
					if($_SESSION['message'] == 'Taki login już istnieje!'){
						echo "<script type=\"text/javascript\">window.alert('Taki login już istnieje!');</script>";
					}else if($_SESSION['message'] == 'Taki mail już istnieje!'){
						echo "<script type=\"text/javascript\">window.alert('Taki mail już istnieje!');</script>";
					}else
					header("Location: login.php");}							
					}else {$message='Hasła się nie pokrywają';
					?> <a href="register.php">Wróć do formularza</a>
					<?php
					}
			}
        ?>
    </head>
    <body>
        <?php
            $message= '';
        ?>
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
            <section id="opis">
            Witam na stronie!<br>
            Wypełnij formularz, aby utworzyć nowe konto.<br>
            </section>
                <section id="loguj">
                    <form action="register.php" method="POST" id="regiform">
                        <center>
                        <table>
                            <tr>
                                <td>Login:</td>
                                <td>
                                    <input type="text" name="login" maxlength="30" value="<?php if(isset($_POST['login'])) echo $_POST['login'] ?>" required="required" />
                                </td>
                            </tr>
                            <tr>
                                <td>Hasło:</td>
                                <td>
                                    <input type="password" name="password" maxlength="100" required="required" />
                                </td>
                            </tr>
                            <tr>
                                <td>Powtórz hasło:</td>
                                <td>
                                    <input type="password" name="pass2" maxlength="100" required="required" />
                                </td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td>
                                    <input type="text" name="mail" maxlength="100" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>" required="required" />
                                </td>
							</tr>
							<tr>
								<td>Data urodzenia:</td>
								<td>
									<input type="text" name="date" required="required" />
								</td>
                            </tr>
                        </table>
                            </center>
                        <input type="submit" name="wyslij" value="Wyślij" class="greenButton" />
                    </form>
                </section>
                
            </div>        
    </body>
</html>
