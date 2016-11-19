<?php
// Check if the articleList is up to date


$farticles = scandir(__DIR__ . "/../ARTICLES"); // the files in the system
$articles =	json_decode(file_get_contents("../articleList"), true); // the meta data

// Check if all the files in the system is in the list
foreach ($farticles as $farticle){
	if($farticle=='.' || $farticle=='..') continue; // ignore these two
	if(!isset($articles[$farticle])) { // if the file isn't in the list, then add it
		$article["title"] = $farticle; // set it's title to the filename, since it is lost
		$article["filename"] = $farticle; // set it's title to the filename, since it is lost
		$articles[$farticle] = $article;
	}
}

// Check if all the files in the list actually exists on the server or else remove them from the list
foreach (array_keys($articles) as $article){
	if(!in_array($article, $farticles)){
		$articles[$article] = null; // need to remove the value first or php gets upset
		unset($articles[$article]); // unset the key
	}
}
file_put_contents("../articleList", json_encode($articles));
//echo json_encode($articles);
?>