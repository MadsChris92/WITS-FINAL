<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WITS Wiki</title>
	<link rel="stylesheet" href="../CSS/Style.css">
</head>
<body>
<div class="top">WITS-Wiki</div>

<div class="left">
	<?php

	$farticles = scandir(__DIR__ . "/../ARTICLES");

	foreach ($farticles as $farticle){
		if($farticle=='.' || $farticle=='..') continue;
		echo "<a href='article.php?link=".$farticle."'>".$farticle."</a><br>";
	}



	?>
</div>

<div class="main">
	<?php
	if(isset($_GET['link'])){
		echo file_get_contents(__DIR__ . "/../ARTICLES/".$_GET['link']);
	}
	?>
</div>
</body>
</html>
