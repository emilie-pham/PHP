<div class="products-wrapper">
	<ul class="products">
	<?php
		if (file_exists("./private/products"))
			$product_file = unserialize(file_get_contents("./private/products"));
		$category = $_GET['category'];
		if (!$product_file)
			echo '<iframe src="https://giphy.com/embed/PP3tWd7BPtWqC4IH6A" width="100%" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/SNL-snl-saturday-night-live-season-44-PP3tWd7BPtWqC4IH6A"></a></p>';
		else
		{
			if (!$_GET['category']){
				foreach ($product_file as $key => $categories)
				{?>
					<li>
						<a href="#"><img src="<?echo $product_file[$key]["image"];?>">
						<h4><?echo $product_file[$key]["name"];?></h4>
						<p><?echo $product_file[$key]["price"]."€";?></p></a>
						<form action="cart.php" method="POST">
							<i class="fas fa-plus"><input type="submit" name="product" value="<?echo $product_file[$key]["name"]?>"/></i>
						</form>
					</li><?
				}
			}
			else {
				foreach ($product_file as $key => $categories)
				{
					foreach ($categories['categories'] as $cat){
						if ($category === $cat || $category === ""){?>
							<li>
								<a href="#"><img src="<?echo $product_file[$key]["image"];?>">
								<h4><?echo $product_file[$key]["name"];?></h4>
								<p><?echo $product_file[$key]["price"]."€";?></p></a>
								<form action="cart.php" method="POST">
									<i class="fas fa-plus"><input type="submit" name="product" value="<?echo $product_file[$key]["name"]?>"/></i>
								</form>
							</li><?
						}
					}
				}
			}
		}
	?>
	</ul>
</div>
