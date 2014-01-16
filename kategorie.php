<section id="kategorie">
            <h1>Kategorie</h1>
                <ul>
                <?php
					include('classes/categories.inc');
					$categories = new Categories();
					$cat = $categories->getCategories();
					foreach($cat as $val){						
						$tmp = $val[0];
						?>
						<li><a href="kategoria.php?category=<?php echo $tmp; ?>"><?php echo $tmp; ?></a></li>
						<?php
					}
					if(isset($_SESSION['serial'])){
				?>
				<li><a href="usunKat.php">Usuń kategorię</a></li>
				<li><a href="dodajKat.php">Dodaj kategorię</a></li>
				<?php
				}
				?>
                </ul>
            </section>