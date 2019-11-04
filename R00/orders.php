<?php

	if (file_exists("./private/archives"))
		$archive_file = unserialize(file_get_contents("./private/archives"));

?>
<head>
	<link rel="stylesheet" href="index.css">
</head>
<div id="main">
	<h1 class="h1-historic">L'historique de commandes</h1>
	<div class="orders-list">
		<div class="order-description">
			<p class="command">Commande du : xxx</p>
		</div>
		<div class="order-detail">
			<p class="info-order">Acheteur : coucou</p>
			<p class="info-order">Produits :</p>
			<table>
				<tr>
					<td>Name produit</td>
					<td>Prix</td>
					<td>Quantité</td>
				</tr>
			</table>
			<p class="info-order">Prix total : xxx</p>
		</div>

		<br>
		<a href="./admin.php"><i>Retour page admin</i></a><br />

	</div>
</div>
