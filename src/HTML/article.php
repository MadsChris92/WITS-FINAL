<?php

$farticles = scandir(__DIR__ . "/articles");

file_put_contents("articleList", implode("\n", $farticles));

foreach ($farticles as $farticle){
	echo $farticle;
}

?>