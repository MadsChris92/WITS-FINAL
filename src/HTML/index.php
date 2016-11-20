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
		if(isset($articleNames[$article]) && $article!=null)
			echo "<a href='index.php?link=".$article."'>".$articleNames[$article]."</a><br>";
		else
			echo "<a href='index.php?link=".$article."'>".$article."</a><br>";
	}
	?>
	<a href='index.php?new=1'>+New Page</a>
</div>

<div class="main">
	<form method='post' action='save.php' target="_self">
		<?php
		if(isset($_GET['link']))
			echo "<input type='hidden' name='link' value='".$_GET['link']."'>";
		?>
		<div id='mainTxt'>
			<?php

			if(isset($_GET['link'])){
				$contents = explode("|", file_get_contents(__DIR__ . "/../ARTICLES/".$_GET['link']));
				if(sizeof($contents)>1)
					echo $contents[1];
				else
					echo $contents[0];
			} elseif(isset($_GET['new'])){
				echo file_get_contents("newpage.html");
			} else {
				echo file_get_contents("welcome.html");
			}

			?>
		</div>
	</form>

	<div class="bottom">
		<?php
		if(isset($_GET['link'])){
			echo '<button id="knas" onclick="onClickEdit()">Edit Article</button>';
			echo "<a href='delete.php?link=".$_GET['link']."' id='delete_article' onclick='return onClickDelete()'>Delete Article</a>";
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
				document.getElementById("mainTxt").innerHTML = document.getElementById("hide").value;
				document.getElementById("knas").onclick = onClickEdit;
				document.getElementById("knas").innerHTML = "Edit Article";
			}

			function onClickDelete() {
				return confirm("Are you completely sure you want to delete this article?");
			}
		</script>
	</div>
</div>
</body>
</html>
