<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WITS Wiki</title>
	<link rel="stylesheet" href="../CSS/Style.css">
	<?php
	include "list.php";
	?>
</head>
<body>
<div class="top">WITS-Wiki</div>

<div class="left">
	<?php
	foreach ($articles as $article){
		if(isset($articleNames[$article]))
			echo "<a href='article.php?link=".$article."'>".$articleNames[$article]."</a><br>";
		else
			echo "<a href='article.php?link=".$article."'>".$article."</a><br>";
	}
	?>
</div>

<div class="main" id="mainTxt">
	<?php
	if(isset($_GET['link'])){
		$contents = explode("|", file_get_contents(__DIR__ . "/../ARTICLES/".$_GET['link']));
		if(sizeof($contents)>1)
			echo $contents[1];
		else
			echo $contents[0];
	}
	?>

	<button onclick="onClick()">Edit Article</button>

	<script>
		function onClick() {
			var t = document.getElementById("mainTxt").innerHTML;
			t.backgroundColor = "BLUE";
			document.getElementById("mainTxt").innerHTML = "<textarea></textarea>"
		}
	</script>

</div>
</body>
</html>
