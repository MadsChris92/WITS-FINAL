<?php

if(isset($_GET['link'])){
	$farticles = scandir(__DIR__ . "/../ARTICLES"); // the files in the system
	$file = array_search($_GET['link'], $farticles);
	if($file == false){
		echo "File '".$_GET['link']."' was not found";
	} else {
		$path = realpath(__DIR__ . "/../ARTICLES/" . $farticles[$file]); // get the path
		unlink($path); // delete the file

		// remove the meta data (only for version 2)
		$articles =	json_decode(file_get_contents("../articleList"), true);
		$articles[$farticles[$file]] = null; // need to remove the value first or php gets upset
		unset($articles[$farticles[$file]]); // unset the key
		file_put_contents("../articleList", json_encode($articles));

		// return to the start page
		echo "File '".$_GET['link']."' was removed";
		header("Location: ".'http://'. $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/index.php');
	}
} else {
	echo "No file specified";
}
?>