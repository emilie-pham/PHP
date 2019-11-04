<?php
	session_start();
	// $_SESSION['cart'] = array();

	function	calc_total($price, $quantity)
	 {
		return ($price * $quantity);
	 }

	function	del_item($product)
	{
		foreach ($_SESSION['cart'] as $k => $v)
		{
			if ($_SESSION['cart'][$k]['name'] === $product)
			{
				unset($_SESSION['cart'][$k]);
				array_values($_SESSION['cart']);
				break ;
			}
		}
	}

	function	more_quantity($product)
	{
		foreach ($_SESSION['cart'] as $k => $v)
		{
			if ($_SESSION['cart'][$k]['name'] === $product)
			{
				$_SESSION['cart'][$k]['quantity'] += 1;
				break ;
			}
		}
	}

	function	add_to_cart($product, $file)
	{
		$newproduct = 1;
		foreach ($_SESSION['cart'] as $k => $v)
		{
			if ($_SESSION['cart'][$k]['name'] === $product)
			{
				more_quantity($product);
				$newproduct = 0;
				break ;
			}
		}
		if ($newproduct === 1){
			foreach ($file as $k => $v)
			{
				if ($file[$k]['name'] === $product)
				{
					$tmp['name'] = $file[$k]['name'];
					$tmp['price'] = $file[$k]['price'];
					$tmp['image'] = $file[$k]['image'];
					$tmp['quantity'] = 1;
					$_SESSION['cart'][] = $tmp;
				}
			}
		}
	}

	function	create_cart()
	{
		$_SESSION['cart'] = array();
	}

	// ajout d'un produit au panier
	$product = $_POST['product'];
	$product_file = unserialize(file_get_contents("./private/products"));
	
	// si pas panier
	if (!$_SESSION['cart'])
		create_cart();

	// on ajoute le produit au panier
	add_to_cart($product, $product_file);

		// si pas d'utilisateur logged

			// redirection page connexion

		// on copie SESSION cart dans un TMP qu'on copi dans la session du user logged

		// on enregistre dans fichier archives

	// Delete product from cart
	if ($_GET['delete']) {
		foreach ($_SESSION['cart'] as $k => $v) {
			if ($v['name'] == $_GET['delete']) {
				unset($_SESSION['cart'][$k]);
			}
		}
	}

	// Change value of quantity
	if ($_POST['submit'] === "change" && $_POST['quantity']){
		foreach ($_SESSION['cart'] as $k => $v) {
			if ($v['name'] == $_POST['product']) {
				$_SESSION['cart'][$k]['quantity'] = $_POST['quantity'];
			}
		}
	}
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/index.css">
	<link rel="stylesheet" href="/users/myaccount.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<title>Document</title>
</head>
<div id="main">
	<?php include_once 'navigation.php'; ?>
	<div class="cart-wrapper">
		<h2 class="h2-account">🛒 Mon panier</h2>
		<table class="shopping-cart">
			<tr>
				<th class="invisible"></th>
				<th>Image</th>
				<th>Produit</th>
				<th>Prix / item</th>
				<th>Quantité</th>
				<th>Prix total</th>
			</tr>

				<?php
				if (!$_SESSION['cart'])
					echo '<iframe src="https://giphy.com/embed/PP3tWd7BPtWqC4IH6A" width="100%" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/SNL-snl-saturday-night-live-season-44-PP3tWd7BPtWqC4IH6A"></a></p>';
				$total = 0;
				foreach ($_SESSION['cart'] as $k => $v)
				{?>
					<tr>
						<td class="product-removal">
							<a href="cart.php?delete=<?echo $v['name']?>"><img src="https://i.imgur.com/bI4oD5C.png"></a>
						</td>
						<td class="product-image"><img src="<?echo $_SESSION['cart'][$k]['image'];?>"></td>
						<td class="product-name"><?echo $_SESSION['cart'][$k]['name'];?></td>
						<td class="product-price"><?echo $_SESSION['cart'][$k]['price']."€";?></td>
						<td class="product-quantity">
							<form action="" method="POST">
								<input type="number" name="quantity" value="<?echo $_SESSION['cart'][$k]['quantity'];?>"/>
								<input name="product" value="<?echo $_SESSION['cart'][$k]['name'];?>" style="opacity: 0;"/>
								<input type="submit" name="submit" value="change"/>
							</form>
						</td>
						<td class="product-line-price"><?echo $sub_total = calc_total($_SESSION['cart'][$k]['price'], $_SESSION['cart'][$k]['quantity']);?></td>
						<?
						$total += $sub_total;
				}
				?>
			</tr>
			<tr>
				<td colspan="4"></td>
				<th>Total</th>
				<td class="total"><?php echo $total;?></td>
			</tr>
		</table>
		<a href="validate.php"><button class="valid-cart">Valider mon panier</button></a>
	</div>
</div>
