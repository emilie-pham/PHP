<html>
	<div>
		<h2 class="h2-cat">Nos catégories</h2>
		<ul class="cat-list">
			<?php
				$cat_file = unserialize(file_get_contents("./private/categories"));
				if (!$cat_file)
					echo "<p>Pas de catégories</p>";
				else {
					foreach ($cat_file as $k => $v){
						?>
						<li><a href = "index.php?category=<?echo $cat_file[$k]["name"]?>"><?echo $cat_file[$k]["name"]?></a></li>
						<?
					}
				}
			?>
		</ul>
	</div>
</html>
