<?php

require_once('./inc/functions.php');
require_once('./controller/clotheController.php');

$functions = new Functions();
$clotheController = new clotheController();

// Picks up all available clothing items
$clothes = json_decode($clotheController->getAll());
shuffle($clothes);

// Performs the "purchase" of a piece of clothing
if (isset($_GET['clothe_id'])) {
	$id = $_GET['clothe_id'];

	$clotheController->buy($id);
}

// Clear shopping list
if (isset($_GET['clean'])) {
	$clotheController->destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="view/style.css">
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
		rel="stylesheet" />
</head>

<body style="font-family: 'Poppins';">
	<h1 class="title">Cloths Available in Stock</h1>
	<a href="?clean" class="clean">Clear shopping list</a>
	<div id="clothes" class="container">

		<?php
		for ($i = 0; $i < count($clothes); $i++) {
			?>

			<div class="clothe-card">
				<img src="<?= $clothes[$i]->image ?>" alt="<?= $clothes[$i]->name ?>" />
				<h5>
					<?= $clothes[$i]->name ?>
				</h5>

				<?php
				if ($functions->alreadyPurchased($clothes[$i]->id)) {
					echo "<p class='purchased'>Bought</p>";
				} else {
					echo "<a href='?p=final&clothe_id=" . $clothes[$i]->id . "'>Purchase</a>";
				}
				?>

				<div class="info">
					<p>Gender -
						<?= $clothes[$i]->gender ?>
					</p>
					<p>Material -
						<?= $clothes[$i]->material ?>
					</p>
					<p>Color -
						<?= $clothes[$i]->color ?>
					</p>
					<p>Origin -
						<?= $clothes[$i]->origin ?>
					</p>
					<p>Type -
						<?= $clothes[$i]->type ?>
					</p>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</body>

</html>