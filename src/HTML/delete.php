<?php

if(isset($_GET['link'])){
	$farticles = scandir(__DIR__ . "/../ARTICLES"); // the files in the system
	$file = array_search($_GET['link'], $farticles);
	if($file == false){
		echo "File '".$_GET['link']."' was not found";
	} else {
		$path = realpath(__DIR__ . "/../ARTICLES/" . $farticles[$file]); // get the path
		unlink($path); // delete the file

		// remove the meta data
		$articles =	json_decode(file_get_contents("../articleList"), true);
		$articles[$farticles[$file]] = null; // need to remove the value first or php gets upset
		unset($articles[$farticles[$file]]); // unset the key
		file_put_contents("../articleList", json_encode($articles));

		echo "File '".$_GET['link']."' was removed";
	}
} else {
	echo "No file specified";
}
?>