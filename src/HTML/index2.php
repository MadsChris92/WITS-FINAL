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
	$articles =	json_decode(file_get_contents("../articleList"), true);
	foreach ($articles as $article){
		if(isset($article["title"]))
			echo "<a href='index2.php?link=".$article["filename"]."'>".$article["title"]."</a><br>";
		else
			echo "<a href='index2.php?link=".$article["filename"]."'>".$article["filename"]."</a><br>";
	}
	?>
	<a href='index2.php?new=1'>+New Page</a>
</div>

<div class="main">
	<script>
		function submitCheck(){
			if(document.getElementById("article_title_input").value == ""){
				return confirm("Are you sure you don't want to enter a title?\n(filename will be used if title left blank)");
			}
			return confirm("Are you sure you want to save this article?");
		}
	</script>
	<form method='post' action='save2.php' target='_self' onsubmit='return submitCheck()'>
		<?php
		if(isset($_GET['link']))
			echo "<input type='hidden' name='link' value='".$_GET['link']."'>";
		?>
		<div id='mainTxt'>
			<?php

			if(isset($_GET['link'])){
				echo file_get_contents("../ARTICLES/".$_GET['link']);
			} elseif(!isset($_GET['new'])) {
				echo file_get_contents("welcome.html");
			}

			?>
		</div>
		<div id='editTxt' <?php if(!isset($_GET['new'])) echo "hidden" ?>>
			<?php echo file_get_contents("newpage.html")?>
		</div>
	</form>

	<div class='bottom'>
		<?php
		if(isset($_GET['link'])){
			echo "<button id='edit_article' onclick='onClickEdit()'>Edit Article</button>";
		}
		?>
		<script>
			function onClickEdit() {
				var content = document.getElementById("mainTxt").innerHTML;
				document.getElementById("mainTxt").setAttribute('hidden', 'hidden');
				document.getElementById("editTxt").removeAttribute('hidden');
				<?php
				if(isset($_GET['link'])){
					echo "document.getElementById('article_file_input').value='" . $_GET['link'] . "';";
					echo "document.getElementById('article_title_input').value='" . $articles[$_GET['link']]['title'] . "';";
				} else {
					echo "document.getElementById('article_file_input').value='';";
					echo "document.getElementById('article_title_input').value='';";
				}
				?>
				document.getElementById("article_content_input").value=content;
				document.getElementById("edit_article").onclick = onClickCancel;
				document.getElementById("edit_article").innerHTML = "Discard Changes";
			}
			function onClickCancel() {
				document.getElementById("mainTxt").removeAttribute('hidden');
				document.getElementById("editTxt").setAttribute('hidden', 'hidden');
				document.getElementById("edit_article").onclick = onClickEdit;
				document.getElementById("edit_article").innerHTML = "Edit Article";
			}
		</script>
	</div>
</div>
</body>
</html>
