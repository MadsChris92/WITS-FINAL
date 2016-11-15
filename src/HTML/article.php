<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WITS Wiki</title>
	<link rel="stylesheet" href="../CSS/Style.css">
	<script src="ajax.js"></script>
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

<div class="main">
	<form method='post' action='save.php'>
		<?php
		if(isset($_GET['link'])){
		echo "<input type='hidden' name='link' value='".$_GET['link']."'>";
		?>
		<div id='mainTxt'>
			<?php
				$contents = explode("|", file_get_contents(__DIR__ . "/../ARTICLES/".$_GET['link']));
				if(sizeof($contents)>1)
					echo $contents[1];
				else
					echo $contents[0];
			}
			?>
		</div>
	</form>

	<div class="functions">
		<?php
		if(isset($_GET['link'])){
			echo '<button id="knas" onclick="onClickEdit()">Edit Article</button>';
		}
		?>
		<input type="hidden" id="hide">
		<script>
			function onClickEdit() {
				var content = document.getElementById("mainTxt").innerHTML;
				document.getElementById("hide").value = content;
				document.getElementById("mainTxt").innerHTML =''+
					'<textarea name="content" class="txt" id="txt">' + content + '</textarea>'+
					'<input type="submit" value="Save Changes">';
				document.getElementById("knas").onclick = onClickCancel;
				document.getElementById("knas").innerHTML = "Discard Changes";
			}
			function onClickCancel() {
				var content = document.getElementById("txt").innerHTML;
				document.getElementById("mainTxt").innerHTML = document.getElementById("hide").value;
				document.getElementById("knas").onclick = onClickEdit;
				document.getElementById("knas").innerHTML = "Edit Article";
			}
		</script>
	</div>
</div>
</body>
</html>
