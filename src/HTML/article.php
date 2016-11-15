<?php

$farticles = scandir(__DIR__ . "/../ARTICLES");

foreach ($farticles as $farticle){
	echo $farticle;
}

?>