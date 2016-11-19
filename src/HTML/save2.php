<?php

if(isset($_POST['link'])){
	$filename = $_POST['link'];
	if(isset($_POST['content'])){
		$articles =	json_decode(file_get_contents("../articleList"), true); // the meta data
		if(isset($articles[$filename])){
			$article = $articles[$filename];
		} else {
			$article['filename'] = $filename;
		}

		if(isset($_POST['title']) && $_POST['title']!=""){
			$article['title'] = $_POST['title'];
		} elseif(!isset($article['title'])) {
			$article['title'] = $filename;
		}

		$content = $_POST['content'];
		file_put_contents("../ARTICLES/".$filename, $content);

		$articles[$filename] = $article;
		file_put_contents("../articleList", json_encode($articles));

		echo 'http://'. $_SERVER['SERVER_NAME'] . '<br>';
		echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '<br>';
		echo 'http://'. $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/index2.php?link=' . htmlentities($filename);
		//header("Location: ".$_SERVER['HTTP_REFERER']);
		header("Location: ".'http://'. $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/index2.php?link=' . htmlentities($filename));

	}
}
?>