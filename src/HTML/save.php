<?php
include "list.php";

if(isset($_POST['link'])){
	$article = $_POST['link'];
	if(isset($_POST['content'])){
		$content = $_POST['content'];
		if(isset($_POST['title'])){
			$title = $_POST['title'];
		} elseif(isset($articleNames[$article])) {
			$title = $articleNames[$article];
		} else {
			$title = $article;
		}
		file_put_contents("../ARTICLES/".$article, $title."|".$content);

		header('Location: '.$_SERVER['HTTP_REFERER']);

	}
}

?>