<?php
$farticles = scandir(__DIR__ . "/../ARTICLES");

$articles = "";
$articleNames = null;
foreach ($farticles as $farticle){
	if($farticle=='.' || $farticle=='..') continue;
	$articles = $articles.'&'.$farticle;
	$contents = explode("|", file_get_contents(__DIR__ . "/../ARTICLES/".$farticle));
	if(sizeof($contents)>1)
		$articleNames[$farticle] = $contents[0];
}
$articles = explode("&", $articles);
?>